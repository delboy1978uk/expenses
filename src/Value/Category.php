<?php

namespace Del\Expenses\Value;

use Del\Common\Value\ValueInterface;
use InvalidArgumentException;

class Category implements ValueInterface
{
    const INCOME_INVOICE = 'invoice';
    const INCOME_LOAN_REPAYMENT = 'loanpayback';

    const EXPENSE_ACCOMMODATION = 'accommodation';
    const EXPENSE_BILL = 'bill';
    const EXPENSE_EQUIPMENT = 'equipment';
    const EXPENSE_FOOD = 'food';
    const EXPENSE_FUEL = 'fuel';
    const EXPENSE_LOAN = 'loan';
    const EXPENSE_EQUPIMENT_HIRE = 'hire';
    const EXPENSE_MISC = 'misc';
    const EXPENSE_SUPPLIES = 'supplies';
    const EXPENSE_TAX = 'tax';
    const EXPENSE_TRANSPORT = 'transport';
    const EXPENSE_WAGES = 'wages';

    private $acceptableValues = [
        self::INCOME_INVOICE, self::INCOME_LOAN_REPAYMENT, self::EXPENSE_ACCOMMODATION,
        self::EXPENSE_BILL, self::EXPENSE_EQUIPMENT, self::EXPENSE_EQUPIMENT_HIRE,
        self::EXPENSE_FOOD, self::EXPENSE_LOAN, self::EXPENSE_FUEL, self::EXPENSE_MISC, self::EXPENSE_SUPPLIES,
        self::EXPENSE_TAX, self::EXPENSE_TRANSPORT, self::EXPENSE_WAGES
    ];

    /** @var string $value */
    private $value;

    /**
     * ValueInterface constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        if (!in_array($value, $this->acceptableValues)) {
            throw new InvalidArgumentException('Not an acceptable value.');
        }
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }


}