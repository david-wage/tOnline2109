<?php

namespace Unit6\NetWorth\Api;

interface CategoryNetWorthManagementInterface
{
    const NET_WORTH_ATTRIBUTE = 'net_worth';

    public function updateAll();

    public function updateCategory($categoryId);
}
