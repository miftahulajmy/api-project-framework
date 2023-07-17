<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
{
    public $status;
    public $message;
    /**
     * Transform the resource into an array.
     *
     * @param mixed $status
     * @param mixed $message
     * @param mixed
     * @return void
     */

     public function __construct($status, $message, $resource)
     {
         parent::__construct($resource);
         $this->status = $status;
         $this->message = $message;
     }
    
    public function toArray($request)
    {
      return[
          'success'=> $this->status,
          'message'=>$this->message,
          'data'=>$this->resource
      ];
    }
}
