<?php

namespace App\Services;

class AIContentService
{
    public function generate(array $data): array
    {
        $name = $data['business_name'];
        $type = strtolower($data['business_type']);
        $description = $data['description'];

        // Dynamic tagline pool
        $taglines = [
            "Quality you can trust",
            "Experience excellence every day",
            "Customer satisfaction is our priority",
            "Delivering value beyond expectations",
            "Your trusted partner for success"
        ];

        // Random tagline
        $tagline = $taglines[array_rand($taglines)];

        // Dynamic services based on business type
        $services = [
            ucfirst($type) . " Consulting",
            ucfirst($type) . " Solutions",
            "Customer Support",
            "Professional Assistance"
        ];

        // Dynamic about templates
        $aboutTemplates = [
            "$name is a leading $type business committed to excellence. $description Our mission is to provide high-quality services and build long-term relationships with our customers.",
            
            "At $name, we specialize in $type services. $description We focus on innovation, quality, and customer satisfaction to deliver outstanding results.",
            
            "$name offers reliable and professional $type services. $description With a customer-first approach, we ensure the best experience and continuous improvement."
        ];

        $about = $aboutTemplates[array_rand($aboutTemplates)];

        // Special handling for known business types (more detailed)
        switch ($type) {
            case 'restaurant':
                $tagline = "Delicious food, unforgettable taste";
                $services = [
                    "Dine-in Experience",
                    "Takeaway Services",
                    "Online Food Delivery",
                    "Catering Services"
                ];
                break;

            case 'gym':
                $tagline = "Transform your body, transform your life";
                $services = [
                    "Personal Training",
                    "Weight Training Programs",
                    "Cardio Fitness",
                    "Nutrition Guidance"
                ];
                break;

            case 'salon':
                $tagline = "Enhancing your beauty and confidence";
                $services = [
                    "Hair Styling",
                    "Facial Treatments",
                    "Makeup Services",
                    "Skin Care Solutions"
                ];
                break;
        }

        return [
            'title' => "Welcome to $name",
            'tagline' => $tagline,
            'about' => $about,
            'services' => $services,
        ];
    }
}