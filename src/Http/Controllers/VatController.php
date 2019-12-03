<?php

namespace Vat\Vat\Http\Controllers;

use Illuminate\Http\Request;
use VatApi\Exception\InvalidCodeValueException;
use VatApi\Exception\InvalidNipNumberException;
use VatApi\TaxStatusInterface;
use VatApi\VatApi;

class VatController extends Controller
{
    /**
     * @var VatApi
     */
    private $vatApi;

    public function __construct(VatApi $vatApi)
    {
        $this->vatApi = $vatApi;
    }

    public function checkVat(Request $request) : string
    {
        $nip = $request->nip;
        try {
            $status = $this->vatApi->getNipStatus($nip);

            if ($status === TaxStatusInterface::TAXPAYER_ACTIVE) {
                return json_encode(['status' => true,'message' => 'Podmiot o podanym identyfikatorze podatkowy NIP jest zarejestrowany jako podatnik VAT czynny']);
            } else if ($status === TaxStatusInterface::TAXPAYER_NOT_ACTIVE) {
                return json_encode(['status' => false,'message' => 'Podmiot o podanym identyfikatorze podatkowym NIP nie jest zarejestrowany jako podatnik VAT']);
            } else if ($status === TaxStatusInterface::TAXPAYER_FREE) {
                return json_encode(['status' => true,'message' => 'Podmiot o podanym identyfikatorze podatkowym NIP jest zarejestrowany jako podatnik VAT zwolniony']);
            }
        } catch (InvalidNipNumberException $e) {
            return json_encode(['status' => 'error','message' => $e->getMessage()]);
        } catch (InvalidCodeValueException $e) {
            return json_encode(['status' => 'error','message' => 'Błąd odpowiedzi serwera']);
        }
    }
}
