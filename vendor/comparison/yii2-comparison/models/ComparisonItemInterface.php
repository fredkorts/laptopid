<?php
namespace comparison\comparison\models;

interface ComparisonItemInterface
{
    public function getLabel();
    public function getUniqueId();
}