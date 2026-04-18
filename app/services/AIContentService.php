<?php

namespace App\Services;

class AIContentService
{
    public function generate(array $data): array
    {
        $name = $data['business_name'];
        $type = strtolower($data['business_type']);
        $description = $data['description'];

        // Default values
        $tagline = "Quality service you can trust";
        $services = ["Consultation", "Customer Support"];

        // Dynamic logic based on business type
        switch ($type) {
            case 'restaurant':
                $tagline = "Delicious food, unforgettable taste";
                $services = ["Dine-in", "Takeaway", "Online Delivery"];
                break;

            case 'gym':
                $tagline = "Transform your body, transform your life";
                $services = ["Personal Training", "Weight Training", "Cardio Programs"];
                break;

            case 'salon':
                $tagline = "Enhancing your beauty and confidence";
                $services = ["Hair Styling", "Facial", "Makeup"];
                break;
        }

        return [
            'title' => "Welcome to $name",
            'tagline' => $tagline,
            'about' => "$name is a $type business. $description We are committed to delivering the best experience to our customers.",
            'services' => $services,
        ];
    }
}