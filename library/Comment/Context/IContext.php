<?php
namespace Comment\Context;

interface IContext {
    public function toArray();

    public function toJson();

    public function setType($type);

    public function getType();
} 