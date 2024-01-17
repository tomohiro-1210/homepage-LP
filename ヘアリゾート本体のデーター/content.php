<?php 
$headers = <<<HEAD
From :lounge0810@gmail.com 
Return-Path: lounge0810@gmail.com 
Content-Type: text/plain;charset=ISO-2022-JP 
HEAD;
$result = mail("lounge0810@gmail.com","テストのメールタイトル","テストのメール本文",$headers);
var_dump($result);