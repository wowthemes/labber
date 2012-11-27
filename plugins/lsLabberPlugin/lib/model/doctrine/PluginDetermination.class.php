<?php

/**
 * This abstract class Pluginhas been auto-generated by the Doctrine ORM Framework
 */
abstract class PluginDetermination extends BaseDetermination
{
  public function getCost()
  {
    return $this->getMethod()->cost;
  }

  public function getUM()
  {
    return $this->getScale()->prefix . $this->getUnitOfMeasurement()->symbol;
  }

  public function preUpdate($event)
  {
    foreach ($this->getModified() as $k => $v)
    {
      switch ($k)
      {
        case 'conforme':
          $this->updateHistory('Conforme', $v ? 'Sì' : 'No');
          break;
        case 'valore_inserito':
          $oldValues = $this->getModified(true);

          if (is_null($oldValues[$k]))
          {
            $this->set('data_fine', date('Y-m-d'));
          }

          $params = json_decode($this->params);

          if (isset($params->LOQ) && $params->LOQ > $v)
          {
            $this->set('risultato_formattato', sprintf('<%s', $params->LOQ));
          }
          else
          {
            $this->set('risultato_formattato', $this->resultFormat($v));
          }

          $this->updateHistory('Valorizzato', $v);
          break;
      }
    }
  }

  /**
   * Formatta un numero in base alle cifre significative da usare ma
   * anche in base al massimo numero di cire decimali da mostrare.
   */
  private function resultFormat($value)
  {
    $significative = $this->cifre_significative ? : 3;
    $max_decimali = $this->cifre_decimali ? : 2;
    $moltiplicatore = 1;

    if ($value != 0)
    {
      $numero = floatval($value);

      while ($numero < 0.1)
      {
        $numero *= 10;
        $moltiplicatore /= 10;
      }

      while ($numero >= 1)
      {
        $numero /= 10;
        $moltiplicatore *= 10;
      }

      $c = pow(10, $significative);

      $a = (round($numero * $c) / $c) * $moltiplicatore;

      $c = pow(10, $max_decimali);

      $b = round($a * $c) / $c;
    }
    else
    {
      $b = 0;
    }

    $log10b = log($b) / log(10);

    $parteIntera = floor($log10b) + 1;

    $decimali = $significative - $parteIntera;

    if ($decimali > $max_decimali)
    {
      $decimali = $max_decimali;
    }

    if ($decimali < 0)
    {
      $decimali = 0;
    }

    return number_format($b, $decimali);
  }

  public function updateHistory($action, $value)
  {
    $history = json_decode($this->storico);
    $history[] = array(
      'user' => sfContext::getInstance()->getUser()->getGuardUser()->username,
      'action' => $action,
      'value' => $value,
      'timestamp' => time(),
    );
    $this->setStorico(json_encode($history));
  }

  public function postInsert($event)
  {
    // Setta il numero di riga sequenziale del controllo
    $q = Doctrine_Query::create()->from('Determination d')
        ->where('d.offer_section_id = ?', $this->offer_section_id)
        ->orWhere('d.packet_id = ?', $this->packet_id)
        ->orWhere('d.sample_id = ?', $this->sample_id);

    $this->numriga_report = $q->count() * 10;

    // prende i default dal Method
    $method = Doctrine::getTable('Method')->find($this->method_id);

    // non valorizzare i controlli nei pacchetti/offerte semplici !proto
    if (!$this->scale_id)
    {
      $this->setScaleId($method->prefix_id);
    }
    if (!$this->um_id)
    {
      $this->setUmId($method->um_id);
    }
    if (!$this->cifre_decimali)
    {
      $this->setCifreDecimali($method->max_decimal_digits);
    }
    if (!$this->cifre_significative)
    {
      $this->setCifreSignificative($method->significant_digits);
    }
    if (!$this->price)
    {
      $this->setPrice($method->cost);
    }

    // override della data di scadenza se esplicitata nel Sample
    if ($this->sample_id && $sample_data_scadenza = Doctrine::getTable('Sample')->find($this->sample_id)->data_scadenza)
    {
      $this->setDataScadenza($sample_data_scadenza);
    }

    $this->save();
  }

  public function postDelete($event)
  {
    // Rimuove l'eventuale OfferSectionSource collegata
    if ($s = $this->getRelatedSource())
    {
      $s->delete();
    }
  }

  public function getRelatedSource()
  {
    if (!$this->offer_section_id  && !$this->sample_id)
    {
      return false;
    }

    $q = Doctrine_Query::create();

    if ($this->offer_section_id)
    {
      $q->from('OfferSectionSource s')->where('s.offer_section_id = ?', $this->offer_section_id);
    }
    elseif ($this->sample_id)
    {
      $q->from('SampleSource s')->where('s.sample_id = ?', $this->sample_id);
    }

    return $q->andWhere('s.determination_id = ?', $this->id)->fetchOne();
  }

  public function setTableDefinition()
  {
    parent::setTableDefinition();

    // Unique validator per i Determination non 'deleted_at'
    // collegati ad un Sample, Packet o OfferSection; non crea un
    // index sul db.
    //
    // @see http://www.doctrine-project.org/jira/browse/DC-187
    $this->unique(
      array('sample_id', 'denomination_id', 'method_id', 'params'),
      array('where' => "deleted_at IS NULL"),
      false
    );
    $this->unique(
      array('packet_id', 'denomination_id', 'method_id', 'params'),
      array('where' => "deleted_at IS NULL"),
      false
    );
    $this->unique(
      array('offer_section_id', 'denomination_id', 'method_id', 'params'),
      array('where' => "deleted_at IS NULL"),
      false
    );
  }

  public function save(Doctrine_Connection $conn = null)
  {
    if ($this->sample_id && !is_null($this->valore_inserito))
    {
      $is_comply = true;
      if ($this->limiti != null)
      {
        $is_comply = $this->isComply();
      }
      if (!$is_comply)
      {
        $this->setConforme(false);
        $this->getSample()->conforme = false;
      }
      else
      {
        $this->setConforme(true);
      }
      parent::save($conn);

      $sample = $this->getSample();
      // Controlla se il campione è completato e la conformita dello stesso
      $sample->completed();
    }
    else
    {
      parent::save($conn);
    }
  }

  public function isComply()
  {
    // risultato del confronto tra il valore inserito e il limite
    $result = true;

    foreach (preg_split('~\R~', $this->limiti) as $limit)
    {
      switch ($limit[0])
      {
        case '<':
          $result = $result && $this->valore_inserito < substr($limit, 1);
          break;
        case '>':
          $result = $result && $this->valore_inserito > substr($limit, 1);
          break;
        case 'A': // Assenti
          $result = $this->valore_inserito == 0;
          break;
        default:
          $result = false;
      }
    }

    return $result;
  }

  public function toLabArray()
  {
    $det = array();

    $det['id'] = $this->id;
    $det['sample_id'] = $this->sample_id;
    $det['tipo_controllo'] = $this->tipo_controllo;
    $det['data_inizio'] = $this->data_inizio;
    $det['data_fine'] = $this->data_fine;
    $det['data_scadenza'] = $this->data_scadenza;
    $det['priorita'] = $this->priorita;
    $det['nota_laboratorio'] = $this->nota_laboratorio;
    $det['cifre_decimali'] = $this->cifre_decimali;
    $det['cifre_significative'] = $this->cifre_significative;
    $det['risultato_formattato'] = $this->risultato_formattato;
    $det['valore_inserito'] = is_null($this->valore_inserito) ? null : (float) $this->valore_inserito;
    $det['params'] = $this->params;
    $det['storico'] = $this->storico;
    $det['stampa'] = $this->stampa;
    $det['conforme'] = $this->conforme;
    $det['incertezza'] = $this->incertezza;
    $det['recupero'] = $this->recupero;
    $det['limiti'] = $this->limiti;
    $det['ordername'] = $this->getSample()->getOrder()->numero;
    $det['Denominationname'] = $this->getDenomination()->name;
    $det['Methodname'] = $this->getMethod()->name;
    $det['MethodUnitname'] = $this->getMethod()->getUnit()->name;
    $det['Samplenumero'] = $this->getSample()->numero;
    $det['fullname'] = $this->getSample()->getOrder()->getContact()->name . ' - ' . $this->getSample()->getOrder()->getContact()->alias;
    $det['um'] = $this->getUM();
    $det['Samplestato'] = (int) $this->getSample()->stato;
    $det['denomination_alias'] = $this->denomination_alias;

    $params = json_decode($this->params, true);
    $det['loq'] = $params['LOQ'];
    $det['lod'] = $params['LOD'];

    // TODO: gestire i livelli di inc e rec
    $constants = json_decode($this->constants, true);
    $det['uncertainty'] = $constants['incertezza-unico-livello'];
    $det['recovery'] = $constants['recupero-unico-livello'];

    return $det;
  }
}