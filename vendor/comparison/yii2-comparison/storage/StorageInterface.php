<?php
namespace comparison\comparison\storage;

use comparison\comparison\Comparison;

interface StorageInterface
{
    public function load(Comparison $comparison);
    public function save(Comparison $comparison);
}