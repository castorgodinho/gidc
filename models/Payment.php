<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $payment_id
 * @property int $order_id
 * @property int $amount
 * @property string $start_date
 * @property string $mode
 * @property int $invoice_id
 * @property int $tds_rate
 * @property int $tds_amount
 * @property string $tds_file
 *
 * @property Invoice $invoice
 * @property Orders $order
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'amount', 'invoice_id', 'tds_rate', 'tds_amount'], 'integer'],
            [['file'], 'required'],
            [['start_date'], 'safe'],
            [['mode'], 'string', 'max' => 50],
            [['file'], 'file'],
            [['tds_file'], 'string', 'max' => 100],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'invoice_id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'order_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'payment_id' => 'Payment No.',
            'order_id' => 'Unit No.',
            'amount' => 'Amount',
            'start_date' => 'Payment Date',
            'mode' => 'Mode',
            'invoice_id' => 'Invoice ID',
            'tds_rate' => 'Tds Rate',
            'tds_amount' => 'Tds Amount',
            'tds_file' => 'Tds File',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['invoice_id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['order_id' => 'order_id']);
    }
}
