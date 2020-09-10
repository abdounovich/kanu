<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $types=Type::all();
       return view('types')->with('types',$types);    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  


    public function store(Request $request)
    {
      


        if ($request->isMethod('post')) 
                 
        {
  
         $image_name = $request->file('photo')->getRealPath();
         Cloudder::upload($image_name, null);
         list($width, $height) = getimagesize($image_name);
         $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
       

        $types = new Type();
            $types->type=  $request->get('type');
            $types->prix=$request->get('prix');
            $types->temps=$request->get('temps');
            $types->point=$request->get('point');
            $types->photo=$image_url;
           
    
        $types->save();
    
    }
        return redirect('/types')->with('success', 'type saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        //
    }
}
