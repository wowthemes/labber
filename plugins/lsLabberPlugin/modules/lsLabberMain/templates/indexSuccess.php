<script type="text/javascript">
  Lab.CONFIG = Ext.util.JSON.decode('<?php echo $labber_config ?>');
</script>

<?php use_javascript('../lsLabberPlugin/js/sfDirectStore.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Overrides.js') ?>
<?php use_javascript('../lsLabberPlugin/js/CommonCombo.js') ?>
<?php use_javascript('../lsLabberPlugin/js/VTypes.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Viewport.js') ?>
<?php use_javascript('../lsLabberPlugin/js/MainPanel.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Bus.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Utils.js') ?>
<?php use_javascript('../lsLabberPlugin/js/DataProxyExceptionHandler.js') ?>
<?php use_javascript('../lsLabberPlugin/js/DirectExceptionHandler.js') ?>
<?php use_javascript('../lsLabberPlugin/js/FilterField.js') ?>
<?php use_javascript('../lsLabberPlugin/js/FilteringToolbar.js') ?>
<?php use_javascript('../lsLabberPlugin/js/ObjectWindow.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Columns.js') ?>
<?php use_javascript('../lsLabberPlugin/js/AttachmentFileGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Accettazione/OrdersGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Accettazione/SamplesGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Accettazione/SampleSourceGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Accettazione/OrderForm.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Accettazione/SampleForm.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Accettazione/DeterminationGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Accettazione/DeterminationForm.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Accettazione/CompositePanel.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Accettazione/RawInsert.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Accettazione/InsertFromLimits.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Accettazione/ProtoInsert.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Laboratorio/SamplesTab.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Laboratorio/SamplesGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Laboratorio/SampleDetail.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Laboratorio/DeterminationGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Laboratorio/CompositeGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Laboratorio/RdpGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Configurazione/UserGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Configurazione/PermissionGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Configurazione/DepartmentGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/MyHome/Main.js') ?>
<?php use_javascript('../lsLabberPlugin/js/ux.grid.GridFilters.filter/DateItFilter.js') ?>
<?php use_javascript('../lsLabberPlugin/js/DeterminationProto.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Commerciale/ContactGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Commerciale/ContactForm.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Commerciale/ContactAddressGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Commerciale/ContactAddressForm.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Commerciale/OffersGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Commerciale/OffersRevisionGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Commerciale/OfferForm.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Commerciale/OfferSectionsGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Commerciale/OfferSectionsSourcePriceGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Commerciale/OfferSectionForm.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Commerciale/Bill.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Commerciale/BillSample.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Commerciale/LimitsTable.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/MatrixTree.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/DenominationsGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/FieldTypesGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/ConstantsGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/AnalyticalTechnique.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/ReportColumnGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/Organization.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/UnitOfMeasurementGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/SampleType/SampleType.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/SampleType/SampleTypeGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/SampleType/MatrixTreeSampleType.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/Method/MethodUnitOfMeasurementGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/Method/MethodRuleGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/Method/MethodDeterminationTypeGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/Method/MethodMatrixGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/Method/MethodMatrixTree.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/Method/MethodDenominationGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/Method/MethodConstantGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/Method/MethodReportColumnGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/Method/MethodFieldGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/Method/Method.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/Packet/Packet.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/Packet/PacketGrid.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/Packet/PacketTree.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/LimitsGroup.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/Limit.js') ?>
<?php use_javascript('../lsLabberPlugin/js/Controlli/DenominationsGroup.js') ?>