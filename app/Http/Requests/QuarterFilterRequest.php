<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuarterFilterRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'search' => ['nullable', 'string', 'max:255'],
      'sort'   => ['nullable', 'string', 'in:id,name,created_at'],
      'order'  => ['nullable', 'string', 'in:asc,desc'],
    ];
  }

  public function filters(): array
  {
    return [
      'search' => $this->query('search'),
      'sort'   => $this->query('sort', 'id'),
      'order'  => $this->query('order', 'asc'),
    ];
  }
}
