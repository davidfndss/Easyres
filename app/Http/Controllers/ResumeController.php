<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResumeController extends Controller
{
    use HttpResponses;

    public function index()
    {
        return Resume::select('name', 'worked_at')->get();
    }

    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'worked_at' => 'required|array',
            'worked_at.*' => 'string'
        ]);
    
        if ($validator->fails()) {
            return $this->error('Data invalid', 400, $validator->errors());
        }
    
        $validatedData = $validator->validated();
        $validatedData['worked_at'] = json_encode($validatedData['worked_at']);
    
        $created = Resume::create($validatedData);
    
        if ($created) {
            return $this->response('Resume created', 201, ['id'=> $created->id]);
        }
    
        return $this->error('Resume not created, Internal Server Error', 500);
    }

    public function show(String $id)
    {
        $findResume = Resume::find($id);

        if(!$findResume) {
            return $this->error('Resume not Found', 404);
        }

        return $this->response('Resume Found', 200, ['resume'=> $findResume->name,''=> $findResume->id]);
    }

    public function update(Request $request, String $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string',
            'worked_at' => 'sometimes|array',
            'worked_at.*' => 'string'
        ]);
    
        if ($validator->fails()) {
            return $this->error('Data invalid', 400, $validator->errors());
        }

        $foundResume = Resume::find($id);

        if (!$foundResume) {
            return $this->error('Resume not Found', 404);
        }

        $validatedData = $validator->validated();
        $updated = $foundResume->update($validatedData);

        if (!$updated) {
            return $this->error('Resume not Updated', 500);
        }

        return $this->response('Resume updated successfully',200);
    }

    public function destroy(Request $request, String $id)
    {
        $findResume = Resume::find($id);

        if(!$findResume) {
            return $this->error('Resume not Found', 404);
        }

        $password = $request->query('password');

        if (!$password || $password !== env('DELETE_PASSWORD')) {
            return $this->error('Unauthorized', 401);
        }

        Resume::destroy($id);

        return $this->response('Resume Deleted successfully', 200);
    }
}
