<?php
/*
2020-07-07 - Michael Grunewalder (michael@grunewalder.com):
added "implements RedirectResponseInterface" required for redirection to gateway
*/

namespace Omnipay\Eghl\Message;


use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @var  AbstractRequest
     */
    protected $request;

    private $testUrl = 'https://test2pay.ghl.com/IPGSG/Payment.aspx';

    private $liveUrl = 'https://securepay.e-ghl.com/IPG/Payment.aspx';

    public function __construct(AbstractRequest $request, $data)
    {
        parent::__construct($request, $data);
    }

    public function getRedirectUrl()
    {
        return $this->request->getTestMode() ? $this->testUrl : $this->liveUrl;
    }

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function isTransparentRedirect()
    {
        return true;
    }

    public function getTransactionId()
    {
        return $this->data['PaymentID'];
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return $this->data;
    }

}