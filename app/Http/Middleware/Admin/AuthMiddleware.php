<?php

namespace App\Http\Middleware\Admin;
/*use App\Models\ChefModel;
use App\Models\DishModel;
use App\Models\VendorModel;
use App\Models\ProductModel;
use App\Models\ProjectModel;*/

use Closure;
use Sentinel;
use Session;
use Flash;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \App::setlocale('en');
        $obj_user = Sentinel::check();
        

        view()->share('admin_panel_slug',config('app.project.admin_panel_slug'));

        if($obj_user!=false)
        { 

            $super_admin_details = $obj_user->toArray();
            view()->share('shared_admin_details',$super_admin_details);
            view()->share('profile_image_base_img_path',base_path().config('app.project.img_path.user_profile_image'));
            view()->share('profile_image_public_img_path',url('/').config('app.project.img_path.user_profile_image'));
            view()->share('default_img_path',url('/').config('app.project.img_path.user_default_img_path'));
           /* view()->share('dish_default_img',url('/').config('app.project.img_path.default_dish_image'));
            view()->share('default_img',url('/').config('app.project.img_path.chef_default_img'));
            view()->share('customer_default_img',url('/').config('app.project.img_path.default_profile'));
            view()->share('food_panel_slug',config('app.project.food_panel_slug'));
            view()->share('business_approval_count',$this->get_approval_count());
            view()->share('dish_approval_count',$this->get_dish_count());
            view()->share('vendor_business_approval_count',$this->get_business_approval_count());
            view()->share('product_approval_count',$this->get_product_count());
            view()->share('project_approval_count',$this->get_project_count());*/
             
            $user = Sentinel::check();
            
            if($user!=null)
            {
                if($user->inRole(config('app.project.admin_panel_slug')))
                {   
                    
                    return $next($request);
                }
                else
                {   
                    Sentinel::logout();
                    Session::flush();   
                    Flash::error('Invalid Login credentials');
                    return redirect(url(config('app.project.admin_panel_slug').'/login'));
                }   
                    
            }
            else{

                Sentinel::logout();
                Session::flush();
                Flash::error('Session expired');
                return redirect(url(config('app.project.admin_panel_slug').'/login'));
            }
            
            
        }
        else
        {
            Sentinel::logout();
            return redirect(config('app.project.admin_panel_slug'));
        }

    }

    public function get_approval_count()
    {
        $count = 0;
        $count = ChefModel::where('business_verified','0')
                            ->whereHas('user_details',function($q){
                                $q  = $q->where('is_active','1');
                            });
                            $count = $count->count();
        return $count;
    }
    public function get_dish_count()
    {
        $count = 0;
        $count = DishModel::where('is_approved','0')
                        ->whereHas('get_chef_details',function(){})
                        ->count();

        return $count;
    }

    public function get_business_approval_count()
    {
        $count = 0;
        $count = VendorModel::where('business_verified','0')
                            ->whereHas('user_details',function($q){
                                $q  = $q->where('is_active','1');
                            });
                            $count = $count->count();
        return $count;
    }
    public function get_product_count()
    {
        $count = 0;
        $count = ProductModel::where('is_approved','0')
                        ->whereHas('get_vendor_details',function(){})
                        ->count();

        return $count;
    }

    public function get_project_count()
    {
        $count = 0;
        $count = ProjectModel::where('is_approved','0')
                        ->whereHas('get_client_details',function(){})
                        ->count();

        return $count;
    }
}
