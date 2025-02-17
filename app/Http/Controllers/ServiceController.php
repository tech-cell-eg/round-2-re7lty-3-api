<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\ServiceRequest;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    use ApiResponseTrait;

    // Show all services
    public function index() {
        $services = Service::orderBy('id', 'desc')->paginate(8);
        if ($services->isEmpty()) {
            return $this->errorResponse('No services found.', 404);
        }
        return $this->successResponse($services, 'All services retrieved successfully.');
    }

    // Show service by ID
    public function show($id) {
        $service = Service::find($id);
        if (!$service) {
            return $this->errorResponse('Service not found.', 404);
        }
        return $this->successResponse($service, 'Service retrieved successfully.');
    }

    // Create a new service
    public function store(ServiceRequest $request) {
        $data = $request->validated();
        if (empty($data)) {
            return $this->errorResponse('Validation failed.', 400);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $service = Service::create($data);
        if (!$service) {
            return $this->errorResponse('Failed to create service.', 500);
        }
        return $this->successResponse($service, 'Service created successfully.');
    }

    // Update a service
    public function update(ServiceRequest $request, $id) {
        $service = Service::find($id);
        if (!$service) {
            return $this->errorResponse('Service not found.', 404);
        }

        $data = $request->validated();
        if (empty($data)) {
            return $this->errorResponse('Validation failed.', 400);
        }

        // Handle image update
        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $updated = $service->update($data);
        if (!$updated) {
            return $this->errorResponse('Failed to update service.', 500);
        }
        return $this->successResponse($service, 'Service updated successfully.');
    }

    // Delete a service
    public function destroy($id) {
        $service = Service::find($id);
        if (!$service) {
            return $this->errorResponse('Service not found.', 404);
        }

        // Delete the image if exists
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        if ($service->delete()) {
            return $this->successResponse(null, 'Service deleted successfully.');
        }
        return $this->errorResponse('Failed to delete service.', 500);
    }
}
