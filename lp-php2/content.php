<?php 
$headers = <<<HEAD
From :express22212270@gmail.com 
Return-Path: express22212270@gmail.com 
Content-Type: text/plain;charset=ISO-2022-JP 
HEAD;
$result = mail("express22212270@gmail.com","テストのメールタイトル","テストのメール本文",$headers);
var_dump($result);