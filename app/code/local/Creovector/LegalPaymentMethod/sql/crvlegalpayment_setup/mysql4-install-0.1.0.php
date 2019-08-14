<?php

$installer = $this;
$installer->startSetup();

$sql = <<<SQLTEXT
    drop table if exists {$this->getTable('crvlegalpayment/order')}; create table {$this->getTable('crvlegalpayment/order')} (id int not null auto_increment,
    order_id int, 
    company varchar(255),
    tax varchar(255),
    classifier varchar(255),
    bankaccount varchar(255),
    bankсorresponding varchar(255),
    banknumber varchar(255),
    bankname varchar(255),
    primary key(id)) CHARACTER SET utf8;       
        
SQLTEXT;
$installer->run($sql);

$installer->endSetup();
?>