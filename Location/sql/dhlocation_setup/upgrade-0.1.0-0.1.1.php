<?php

$installer = $this;
$installer->startSetup();

$columnOptions = array(
    'TYPE'      => Varien_Db_Ddl_Table::TYPE_TEXT,
    'NULLABLE'  => true,
    'LENGTH'    => Varien_Db_Ddl_Table::DEFAULT_TEXT_SIZE,
    'COMMENT'   => 'Image file name',
);

$installer->getConnection()->addColumn(
    $installer->getTable('dhlocation/location'),
    'image',
    $columnOptions
);

$installer->endSetup();
