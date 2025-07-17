<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function get_list(Request $request)
    {
        $response = [
            'data' => [],
            'message' => '',
        ];
        $http_code = 200;

        try {
            $company = $request->company ?? '';
            $role = $request->role ?? '';
            $query = Contact::query();

            if (!empty($company)) {
                $query->where('company', 'like', '%' . $company . '%');
            }
            if (!empty($role)) {
                $query->where('role', $role);
            }

            $response['data'] = $query->get();
        } catch (\Exception $e) {
            $err_message = $e->getMessage();
            $response['message'] = $err_message;
            $http_code = $e->getCode() ?: 400;
        }
        return response()->json($response, $http_code);
    }

    public function update(Request $request, $id)
    {
        $response = [
            'data' => [],
            'message' => '',
        ];
        $http_code = 200;

        try {
            $contact = Contact::where('id', (int) $id)->first();

            if (!empty($contact)) {
                $contact = $this->set_attribute($contact, $request->all());
                $contact->save();

                $response['data'] = $contact;
            } else {
                $response['message'] = 'Contact not found';
            }
        } catch (\Exception $e) {
            $err_message = $e->getMessage();
            $response['message'] = $err_message;
            $http_code = $e->getCode() ?: 400;
        }
        return response()->json($response, $http_code);
    }

    protected function set_attribute(Contact $contact, $params)
    {
        if (isset($params['is_favorite'])) {
            $contact->is_favorite = $params['is_favorite'];
        }

        return $contact;
    }
}
