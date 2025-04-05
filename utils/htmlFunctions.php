<?php

function isEmail(string $emailInput) : bool {
    if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", trim($emailInput))) {
        return true;
    }
    return false;
}