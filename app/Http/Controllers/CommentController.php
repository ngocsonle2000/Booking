<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataComment = comment::where('idAdmin', Auth::guard('custom')->user()->id)->orderBy('created_at', 'DESC')->where('parent_id', '0')->get();
        return view('user.Comment.index', compact('dataComment'));
    }

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
    public function store(Request $request, $CodeOrders, $idHotel, $idAdmin)
    {
        //
        if(comment::insert([
            'CodeOrders' => $CodeOrders,
            'Comment'    => $request -> comment,
            'Ratings'    => $request -> rate,
            'idHotel'    => $idHotel,
            'idAdmin'    => $idAdmin,
            'idUser'     => Auth::guard('custom')->user()->id,
        ])){
            return redirect()->back()->with('success', 'Đánh giá thành công');
        }else{
            redirect()->back()->with('error', 'Lỗi đánh giá');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, comment $comment)
    {
        dd($request->comment);
        if($comment -> update([
            'Comment' => $request -> comment,
            'Ratings' => $request -> rate,
        ])){
            redirect()->back()->with('success', 'Sửa comment thành công');
        }else{
            redirect()->back()->with('error', 'Lỗi');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(comment $comment)
    {
        //
    }
    public function parent($CodeOrders, $parent_id, Request $request){
        if(comment::insert([
            'CodeOrders' => $CodeOrders,
            'Comment'    => $request ->comment,
            'parent_id'     => $parent_id,
            'idAdmin'    => Auth::guard('custom')->user()->id,
        ])){
            return redirect()->route('Comment.index')->with('success', 'Trả lời bình luận thành công');
        }else{
            return redirect()-> back()->with('error', 'Trả lời thất bại');
        }
    }
    public function parent_update(Request $request, $id){
        $update = comment::find($id);
        $update -> Comment = $request->comment;
        if( $update->save()){
            return redirect()->back()->with('Success', 'Chỉnh sửa bình luận thành công');
        }else{
            return redirect()->back()->with('error', 'Không thể cập nhập');
        }
    }

}
