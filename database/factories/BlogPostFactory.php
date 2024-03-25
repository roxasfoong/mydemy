<?php

namespace Database\Factories;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $blogcat_id = random_int(1, 6);
        $post_title = $this->faker->sentence(1);
        

        

        switch(random_int(1, 6)){
            case 1 :
                $post_image = 'upload/post/1791424326042171.png';
                break;
                case 2 :
                    $post_image = 'upload/post/1791442423563871.png';
                    break;
                    case 3 :
                        $post_image = 'upload/post/1791442917842920.png';
                        break;
                        case 4 :
                            $post_image = 'upload/post/1791442917842920.png';
                            break;
                            case 5 :
                                $post_image = 'upload/post/1791443054307039.png';
                                break;
                                case 6 :
                                    $post_image = 'upload/post/1791443245370623.png';
                                    break;
            }  
         

        switch($blogcat_id){
        case 1 :
            $post_tags = 'Information Technology,';
            break;
            case 2 :
                $post_tags = 'Business,';
                break;
                case 3 :
                    $post_tags = 'Music,';
                    break;
                    case 4 :
                        $post_tags = 'Photography and Videography,';
                        break;
                        case 5 :
                            $post_tags = 'Marketing,';
                            break;
                            case 6 :
                                $post_tags = 'Design,';
                                break;
        }  

        return [
            'blogcat_id' => $blogcat_id,
            'post_title' => $post_title,
            'post_slug' => strtolower(str_replace(' ','-',$post_title)),
            'post_image' => $post_image,
            'long_descp' => $this->faker->paragraph(5),
            'post_tags' => $post_tags,
            'created_at' => Carbon::Now(),
        ];
    }


    
}
