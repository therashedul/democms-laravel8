<?php

namespace App\Http\Servicecruds;

use App\Models\Post;
use App\Models\Category;
use App\Models\Page;
use DB;
use App\Models\Menu;
use App\Models\Menuitem;
class Menucrud{    
    public function menuindex(){    
        $desiredMenu = '';
        $menuitems='';
        if(isset($_GET['id']) && $_GET['id'] != 'new'){
        $id = $_GET['id'];
        $desiredMenu = Menu::where('id',$id)->first();
        if(!empty($desiredMenu->content)) {
            $menuitems = json_decode($desiredMenu->content);
            $menuitems = $menuitems[0];             
            foreach($menuitems as $menu){                
            
            $menu->title_en = Menuitem::where('id',$menu->id)->value('title_en');
            $menu->name_en = Menuitem::where('id',$menu->id)->value('name_en');
            $menu->slug_en = Menuitem::where('id',$menu->id)->value('slug_en');                  
            
            $menu->title_bn = Menuitem::where('id',$menu->id)->value('title_bn');
            $menu->name_bn = Menuitem::where('id',$menu->id)->value('name_bn');
            $menu->slug_bn = Menuitem::where('id',$menu->id)->value('slug_bn');

            $menu->target = Menuitem::where('id',$menu->id)->value('target');
            $menu->type = Menuitem::where('id',$menu->id)->value('type');
            if(!empty($menu->children[0])){
                foreach ($menu->children[0] as $child) {
            
                $child->title_en = Menuitem::where('id',$child->id)->value('title_en');
                $child->name_en = Menuitem::where('id',$child->id)->value('name_en');
                $child->slug_en = Menuitem::where('id',$child->id)->value('slug_en'); 
                
                $child->title_bn = Menuitem::where('id',$child->id)->value('title_bn');
                $child->name_bn = Menuitem::where('id',$child->id)->value('name_bn');
                $child->slug_bn = Menuitem::where('id',$child->id)->value('slug_bn');

                $child->target = Menuitem::where('id',$child->id)->value('target');
                $child->type = Menuitem::where('id',$child->id)->value('type');
                // echo "<pre>";
                if(isset($child->children[0])){
                    foreach ($child->children[0] as $chil) {

                    $chil->title_en = Menuitem::where('id',$chil->id)->value('title_en');
                    $chil->name_en = Menuitem::where('id',$chil->id)->value('name_en');
                    $chil->slug_en = Menuitem::where('id',$chil->id)->value('slug_en'); 
                    
                    $chil->title_bn = Menuitem::where('id',$chil->id)->value('title_bn');
                    $chil->name_bn = Menuitem::where('id',$chil->id)->value('name_bn');
                    $chil->slug_bn = Menuitem::where('id',$chil->id)->value('slug_bn');

                    $chil->target = Menuitem::where('id',$chil->id)->value('target');
                    $chil->type = Menuitem::where('id',$chil->id)->value('type');
                            // print_r($chil->type);
                    } 
                }           
                }  
            }
            }
        }else{
            $menuitems = Menuitem::where('menu_id',$desiredMenu->id)->get();                    
        }             
        }elseif($_GET['id'] = 'new'){

        }
        else{

        }
            
        //    die();
        return view ('menu',[
            'pages'=>page::all(),
            'categories'=>category::all(),
            'posts'=>post::all(),
            'menus'=>Menu::all(),
            'desiredMenu'=>$desiredMenu,
            'menuitems'=> $menuitems
        ]);
    }	

    public function menustore($request){
        $data = $request->all(); 
        if(Menu::create($data)){ 
        $newdata = Menu::orderby('id','DESC')->first();      
        return redirect()->back()->with('error','Failed to save menu !');
        }
    }	

    public function menuaddCatToMenu( $request){
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = Menu::findOrFail($menuid);

        if($menu->content == ''){
            foreach($ids as $id){
                $data['title_en'] = Category::where('id',$id)->value('title_en');
                $data['name_en'] = Category::where('id',$id)->value('name_en');
                $data['slug_en'] = Category::where('id',$id)->value('slug_en');  
                
                $data['title_bn'] = Category::where('id',$id)->value('title_bn');
                $data['name_bn'] = Category::where('id',$id)->value('name_bn');
                $data['slug_bn'] = Category::where('id',$id)->value('slug_bn');

                $data['type'] = 'category';
                $data['menu_id'] = $menuid;
                $data['updated_at'] = NULL;
                Menuitem::create($data);
            }
        }else{
        $olddata = json_decode($menu->content,true); 
            foreach($ids as $id){
                $data['title_en'] = Category::where('id',$id)->value('title_en');
                $data['name_en'] = Category::where('id',$id)->value('name_en');
                $data['slug_en'] = Category::where('id',$id)->value('slug_en');  
                
                $data['title_bn'] = Category::where('id',$id)->value('title_bn');
                $data['name_bn'] = Category::where('id',$id)->value('name_bn');
                $data['slug_bn'] = Category::where('id',$id)->value('slug_bn');

                $data['type'] = 'category';
                $data['menu_id'] = $menuid;
                $data['updated_at'] = NULL;
                Menuitem::create($data);
    
                $array['type'] = 'category';
                $array['target'] = NULL;
                $array['id'] = Menuitem::where('type', $array['type'])->orderby('id','DESC')->value('id');

                $array['children'] = [[]];
                array_push($olddata[0],$array);
                $oldata = json_encode($olddata);
                $menu->update(['content'=>$olddata]);
            }
        }
    }

    public function menuaddPostToMenu($request){
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = Menu::findOrFail($menuid);
        if($menu->content == ''){
        foreach($ids as $id){

            $data['title_en'] = Post::where('id',$id)->value('title_en');
            $data['name_en'] = Post::where('id',$id)->value('name_en');
            $data['slug_en'] = Post::where('id',$id)->value('slug_en');  
            
            $data['title_bn'] = Post::where('id',$id)->value('title_bn');
            $data['name_bn'] = Post::where('id',$id)->value('name_bn');
            $data['slug_bn'] = Post::where('id',$id)->value('slug_bn');

            $data['type'] = 'post';
            $data['menu_id'] = $menuid;
            $data['updated_at'] = NULL;
            Menuitem::create($data);
        }
        }else{
        $olddata = json_decode($menu->content,true); 
        foreach($ids as $id){

            $data['title_en'] = Post::where('id',$id)->value('title_en');
            $data['name_en'] = Post::where('id',$id)->value('name_en');
            $data['slug_en'] = Post::where('id',$id)->value('slug_en');  
            
            $data['title_bn'] = Post::where('id',$id)->value('title_bn');
            $data['name_bn'] = Post::where('id',$id)->value('name_bn');
            $data['slug_bn'] = Post::where('id',$id)->value('slug_bn');

            $data['type'] = 'post';
            $data['menu_id'] = $menuid;
            $data['updated_at'] = NULL;
            Menuitem::create($data);

            $array['type'] = 'post';
            $array['target'] = NULL;
            $array['id'] = Menuitem::where('type', $array['type'])->orderby('id','DESC')->value('id');

            $array['children'] = [[]];
            array_push($olddata[0],$array);
            $oldata = json_encode($olddata);
            $menu->update(['content'=>$olddata]);
        }
        }
    } 
    
    public function menuaddPaseToMenu($request){
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = Menu::findOrFail($menuid);
        if($menu->content == ''){
        foreach($ids as $id){
            $data['title_en'] = Page::where('id',$id)->value('title_en');
            $data['name_en'] = Page::where('id',$id)->value('name_en');
            $data['slug_en'] = Page::where('id',$id)->value('slug_en');  
            
            $data['title_bn'] = Page::where('id',$id)->value('title_bn');
            $data['name_bn'] = Page::where('id',$id)->value('name_bn');
            $data['slug_bn'] = Page::where('id',$id)->value('slug_bn');


            $data['type'] = 'page';
            $data['menu_id'] = $menuid;
            $data['updated_at'] = NULL;
            Menuitem::create($data);
        }
        }else{
        $olddata = json_decode($menu->content, true); 
        foreach($ids as $id){

            $data['title_en'] = Page::where('id',$id)->value('title_en');
            $data['name_en'] = Page::where('id',$id)->value('name_en');
            $data['slug_en'] = Page::where('id',$id)->value('slug_en');  
            
            $data['title_bn'] = Page::where('id',$id)->value('title_bn');
            $data['name_bn'] = Page::where('id',$id)->value('name_bn');
            $data['slug_bn'] = Page::where('id',$id)->value('slug_bn');

            $data['type'] = 'page';
            $data['menu_id'] = $menuid;
            $data['updated_at'] = NULL;
            Menuitem::create($data);
      

            $array['type'] = 'page';
            $array['target'] = NULL;
            $array['id'] = Menuitem::where('type', $array['type'])->orderby('id','DESC')->value('id');
            $array['children'] = [[]];
            array_push($olddata[0],$array);
            $oldata = json_encode($olddata);
            $menu->update(['content'=>$olddata]);
        }
        }
    }

    public function menuaddCustomLink($request){
        $data = $request->all();
        $menuid = $request->menuid;
        $menu = Menu::findOrFail($menuid);
        if($menu->content == ''){

        $data['title_en'] = $request->link_en;
        $data['name_en'] = $request->link_en;
        $data['slug_en'] = $request->url_en;     
        
        $data['title_bn'] = $request->link_bn;
        $data['name_bn'] = $request->link_bn;
        $data['slug_bn'] = $request->url_bn;
        


        $data['type'] = 'custom';
        $data['menu_id'] = $menuid;
        $data['updated_at'] = NULL;
        Menuitem::create($data);
        }
        
        else{
        $olddata = json_decode($menu->content,true); 

        $data['title_en'] = $request->link_en;
        $data['name_en'] = $request->link_en;
        $data['slug_en'] = $request->url_en;     
        
        $data['title_bn'] = $request->link_bn;
        $data['name_bn'] = $request->link_bn;
        $data['slug_bn'] = $request->url_bn;

        $data['type'] = 'custom';
        $data['menu_id'] = $menuid;
        $data['updated_at'] = NULL;
        Menuitem::create($data);      
                $array = [];
                    $data['title_en'] = $request->link_en;
                    $data['name_en'] = $request->link_en;
                    $data['slug_en'] = $request->url_en;     
                    
                    $data['title_bn'] = $request->link_bn;
                    $data['name_bn'] = $request->link_bn;
                    $data['slug_bn'] = $request->url_bn;

                    $array['type'] = 'custom';
                    $array['target'] = NULL;
                $array['id'] = Menuitem::where('type', $array['type'])->orderby('id','DESC')->value('id');
                
                $array['children'] = [[]];
                array_push($olddata[0],$array);
                $oldata = json_encode($olddata);
                $menu->update(['content'=>$olddata]);
        
        }
    }

  public function menuupdateMenu($request){
    $newdata = $request->all(); 
    $menu=Menu::findOrFail($request->menuid);            
    $content = $request->data; 
    $newdata = [];  
    $newdata['location'] = $request->location;       
    $newdata['content'] = json_encode($content);
    $menu->update($newdata); 
  }

  public function menuupdateMenuItem($request){

    $data = $request->all();    
    // print_r($data);
    // die();
    if( $data){
        $item = Menuitem::findOrFail($request->id);
        $item->update($data);
    }    
    return redirect()->back();
  }

  public function menudeleteMenuItem($id, $key, $in=''){    
     
   
        $menuitem = Menuitem::findOrFail($id);
        //   print_r($menuitem);
        //       die();
        $menu = Menu::where('id',$menuitem->menu_id)->first();
        if($menu->content != ''){
        $data = json_decode($menu->content,true);            
        $maindata = $data[0];            
        if($in == ''){
            unset($data[0][$key]);
            $newdata = json_encode($data); 
            $menu->update(['content'=>$newdata]);                         
        }else{
            unset($data[0][$key]['children'][0][$in]);
            $newdata = json_encode($data);
            $menu->update(['content'=>$newdata]); 
        }
        }
        $menuitem->delete();
        return redirect()->back();
    }	

    public function menudestroy($request){  
        if($request->id){
            Menuitem::where('menu_id',$request->id)->delete();  
            Menu::findOrFail($request->id)->delete();
        }    
        return redirect()->route('superAdmin.menus')->with('success','Menu deleted successfully');
    }	
    
}