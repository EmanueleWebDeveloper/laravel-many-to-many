<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Project;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required',Rule::unique(Project::class)->ignore($this->project), 'max:64'],  //Project sarebbe il nome del database "projects" che con questa formula lo trasforma in automatico e con ignore nel momento in cui lo si modifica "ignora" unique del titolo potendo riscrivere lo stesso title.
            'description' => ['nullable'],
            'cover' => ['nullable','image'],
            'content' => ['nullable'],
            'type_id' => ['nullable', 'exists:types,id']

        ];
    }
}
