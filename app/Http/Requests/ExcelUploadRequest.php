<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ExcelUploadRequest extends FormRequest
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
            "file_excel" => [
                "required",
                "mimes:xlsx"
                ]
        ];
    }

    public function messages()
    {
        return [
            "file_excel.required" => "Обязательно нужно прикрепить file_excel",
            "file_excel.mimes" => "Фрмат файла должен быть xlsx"
        ];
    }

    public function storeFile(): string|JsonResponse
    {
        $file = $this->file("file_excel")->store("/excel");

        if (!$file){
            return Response::json([
                "error" => "Ошибка загрузки файла"
            ], 400);
        }

        return $file;
    }
}
