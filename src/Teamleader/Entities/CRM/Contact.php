<?php

namespace Teamleader\Entities\CRM;

use Teamleader\Actions\FindAll;
use Teamleader\Actions\FindById;
use Teamleader\Actions\Storable;
use Teamleader\Model;

class Contact extends Model
{
    use Storable;
    use FindAll;
    use FindById;

    const TYPE = 'contact';

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'salutation',
        'emails', // { "type": "", "email" : "" }
        'telephones', // { "type": "", "number" : "" }
        'website',
        'addresses', // { "type": "", "address" : "" }
        'language',
        'gender',
        'birthdate',
        'iban',
        'bic',
        'remarks',
        'tags',
        'custom_fields',
        'marketing_mails_consent',
    ];

    /**
     * @var string
     */
    protected $endpoint = 'contacts';

    /**
     * @param array $arguments
     *
     * @return mixed
     */
    public function linkToCompany(
        $arguments = [
            'company_id'     => '',
            'position'       => '',
            'decision_maker' => true,
        ]
    ) {
        $arguments['id'] = $this->attributes['id'];

        $result = $this->connection()->post($this->getEndpoint() . '.linkToCompany', json_encode($arguments, JSON_FORCE_OBJECT));

        return $result;
    }
}
