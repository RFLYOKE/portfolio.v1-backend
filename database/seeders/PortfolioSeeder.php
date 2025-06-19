<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use App\Models\Social;
use App\Models\Experience;
use App\Models\Certification;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate([
            'email' => 'akmalrafly@gmail.com',
        ], [
            'name' => 'Portfolio Admin',
            'password' => bcrypt('akmalrafly-elfErf23#!@'),
        ]);

        $tags = collect([
            ['name' => 'ReactJS', 'path' => '/assets/logos/react.svg'],
            ['name' => 'TailwindCSS', 'path' => '/assets/logos/tailwindcss.svg'],
            ['name' => 'Laravel', 'path' => '/assets/logos/laravel.svg'],
            ['name' => 'Next.js', 'path' => '/assets/logos/next.svg'],
            ['name' => 'MySQL', 'path' => '/assets/logos/mysql.svg'],
            ['name' => 'HTML5', 'path' => '/assets/logos/html5.svg'],
            ['name' => 'CSS3', 'path' => '/assets/logos/css3.svg'],
            ['name' => 'JavaScript', 'path' => '/assets/logos/javascript.svg'],
            ['name' => 'API', 'path' => '/assets/logos/api.svg'],
            ['name' => 'Bootstrap', 'path' => '/assets/logos/bootstrap.svg'],
        ])->mapWithKeys(function ($tag) {
            $model = Tag::firstOrCreate(['name' => $tag['name']], ['path' => $tag['path']]);
            return [$tag['name'] => $model->id];
        });

        $projects = [
            [
                'title' => 'MySkin Web-Application',
                'description' => 'An AI-powered web application for skin disease diagnosis.',
                'sub_description' => [
                    'Built using ReactJS and TailwindCSS.',
                    'Allows users to upload images of skin conditions for AI-driven analysis.',
                    'Provides possible diagnoses and treatment recommendations based on image input.',
                    'Responsive design with a clean and user-friendly interface.',
                ],
                'href' => 'https://myskin-v2.humicprototyping.com/',
                'image' => '/assets/projects/myskin.png',
                'tag_names' => ['ReactJS', 'TailwindCSS'],
            ],
            [
                'title' => 'Easy Pantry',
                'description' => 'An e-commerce platform for selling food and cooking ingredients.',
                'sub_description' => [
                    'Developed using Laravel and TailwindCSS.',
                    'I was responsible for designing and implementing the frontend components.',
                    'Features include product browsing, detailed food item descriptions, and cart system.',
                    'Clean and responsive layout tailored for food e-commerce UX.',
                ],
                'href' => 'https://easy-pantry.shop/',
                'image' => '/assets/projects/easy-pantry.jpeg',
                'tag_names' => ['Laravel', 'TailwindCSS'],
            ],
            [
                'title' => 'Rent House Website',
                'description' => 'A user-friendly and secure house rental platform.',
                'sub_description' => [
                    'Built with Next.js, Tailwind CSS, Laravel, Filament, and MySQL.',
                    'Property search feature based on location and preferences.',
                    'Secure and efficient transaction system between renters and owners.',
                    'Intuitive user interface with advanced filtering options.',
                ],
                'href' => '',
                'image' => '/assets/projects/nidejia.png',
                'tag_names' => ['Next.js', 'TailwindCSS', 'Laravel', 'MySQL'],
            ],
            [
                'title' => 'KOI Fish Selling Website',
                'description' => 'A KOI fish selling website with complete info and online transactions.',
                'sub_description' => [
                    'Developed using HTML, CSS, and JavaScript.',
                    'Showcases a KOI fish catalog with images and prices.',
                    'Detailed information about KOI fish care.',
                    'Online transaction system and interactive product gallery.',
                ],
                'href' => '',
                'image' => '/assets/projects/koi.png',
                'tag_names' => ['HTML5', 'CSS3', 'JavaScript'],
            ],
            [
                'title' => 'E-Commerce Platform',
                'description' => 'An e-commerce platform for selling electronic goods.',
                'sub_description' => [
                    'Built using ReactJS, TailwindCSS, and Connect API.',
                    'Displays products like phones, headphones, and TVs.',
                    'Modern shopping cart and checkout features.',
                    'Responsive, user-friendly design for optimal UX.',
                ],
                'href' => '',
                'image' => '/assets/projects/e-commerce.png',
                'tag_names' => ['ReactJS', 'TailwindCSS', 'API'],
            ],
            [
                'title' => 'Tour Ticket Booking Website',
                'description' => 'A responsive and user-friendly tour ticket booking platform.',
                'sub_description' => [
                    'Developed using Bootstrap and HTML/CSS.',
                    'Ticket booking system and special coupon management.',
                    'Modern and attractive layout design.',
                    'Mobile-friendly and works across devices.',
                ],
                'href' => '',
                'image' => '/assets/projects/tourguide.png',
                'tag_names' => ['Bootstrap', 'HTML5', 'CSS3'],
            ],
            [
                'title' => 'Movie Streaming Website',
                'description' => 'An online movie streaming platform with complete features.',
                'sub_description' => [
                    'Built with ReactJS and Bootstrap.',
                    'Features for streaming, searching, and filtering movies.',
                    'Users can add movies to a watchlist and manage profiles.',
                    'Dynamic design with mobile device support.',
                ],
                'href' => '',
                'image' => '/assets/projects/movies.png',
                'tag_names' => ['ReactJS', 'Bootstrap'],
            ],
        ];
        
        
        foreach ($projects as $data) {
            $project = Project::create([
                'user_id' => $user->id,
                'title' => $data['title'],
                'description' => $data['description'],
                'sub_description' => $data['sub_description'],
                'href' => $data['href'],
                'image' => $data['image'],
            ]);
        
            $tagIds = collect($data['tag_names'])->map(fn($name) => $tags[$name]);
            $project->tags()->sync($tagIds);
        }        

        foreach ([
            ['name' => 'WhatsApp', 'href' => 'https://wa.me/6285801255682?text=Halo%2C%20saya%20ingin%20bertanya.', 'icon' => '/assets/socials/whatsApp.svg'],
            ['name' => 'Linkedin', 'href' => 'https://www.linkedin.com/in/akmal-rafly-dzunurain-721922282', 'icon' => '/assets/socials/linkedIn.svg'],
            ['name' => 'Instagram', 'href' => 'https://www.instagram.com/akml_rafly?igsh=MTNsNjNiNXRnbnVlbQ==', 'icon' => '/assets/socials/instagram.svg'],
        ] as $social) {
            Social::create(array_merge($social, ['user_id' => $user->id]));
        }

        Experience::create([
            'user_id' => $user->id,
            'title' => 'Internship - Frontend Developer',
            'job' => 'MySkin Web Application Development',
            'start_date' => '2023-02-20',
            'end_date' => '2023-05-25',
            'contents' => [
                'Developed and maintained the MySkin web application using React and Tailwind CSS, focusing on clean UI and responsive design.',
                'Implemented secure and scalable front-end features in compliance with standards from the Passive Defense Organization and National Cyberspace Center.',
                'Created reusable and accessible UI components to streamline development and ensure design consistency.',
                'Optimized application performance and user experience across various devices and screen sizes.',
                'Collaborated closely with backend developers and designers to ensure seamless integration and user-friendly workflows.',
            ],
        ]);

        foreach ([
            ['title' => 'Certificate Fullstack Developer by Buildwithangga', 'img' => '/assets/certificates/fullstack.jpg'],
            ['title' => 'Certificate React by Codepolitan', 'img' => '/assets/certificates/1.png'],
            ['title' => 'Certified Developer by Alibaba Cloud', 'img' => '/assets/certificates/Certified-Alibaba.png'],
            ['title' => 'Certificate JavaScript by Codepolitan', 'img' => '/assets/certificates/2.png'],
            ['title' => 'Certificate Bootstrap by Codepolitan', 'img' => '/assets/certificates/3.png'],
            ['title' => 'Certificate React Web-App by Codepolitan', 'img' => '/assets/certificates/4.png'],
            ['title' => 'Certificate Pemrograman Web by Dicoding', 'img' => '/assets/certificates/dicoding_webdsr.jpeg'],
            ['title' => 'Certificate Internship COE HUMIC ENGINEERING', 'img' => '/assets/certificates/humic.png'],
        ] as $cert) {
            Certification::create(array_merge($cert, ['user_id' => $user->id]));
        }
    }
}