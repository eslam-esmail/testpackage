<?php

namespace OlaHub\Services;

use OlaHub\Services\OlaHubAdminServices;
use OlaHub\Repositories\MessageTemplatesRepository;

class MessageTemplatesServices extends OlaHubAdminServices {

    public function __construct() {
        parent::__construct();
        $this->repo = new MessageTemplatesRepository;
        $this->responseHandler = '\OlaHub\ResponseHandlers\MessageTemplatesResponseHandler';
        $this->filterValidator = [
            'is_published' => "in:1,0",
            'code' => "alpha|max:30",
            "message_type" => 'integer',
            'created_by' => "integer",
            'updated_by' => "integer",
            'created_at' => "date_format:Y-m-d h:i:s",
            'updated_at' => "date_format:Y-m-d h:i:s",
        ];
    }

    public function getPrerequestFormData()
    {

        $messageTemplatesTypesRepository = new \OlaHub\Repositories\MessageTemplatesTypesRepository;
        $data = [];
        $messageTemplatesTypesData = $messageTemplatesTypesRepository->findAll($this->select, $this->trash);
        $data["allMessagesTypes"] = $this->handlingResponseCollection($messageTemplatesTypesData,'\OlaHub\ResponseHandlers\MessageTemplatesTypesResponseHandler');
        return $data;
    }


}
