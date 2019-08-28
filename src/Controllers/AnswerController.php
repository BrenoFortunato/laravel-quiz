<?php

namespace PandoApps\Quiz\Controllers;

use PandoApps\Quiz\Models\Alternative;
use PandoApps\Quiz\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use PandoApps\Quiz\DataTables\AnswerDataTable;

class AnswerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param AnswerDataTable $answerDataTable
     * @return \Illuminate\Http\Response
     */
    public function index(AnswerDataTable $answerDataTable)
    {
        return $answerDataTable->render('pandoapps::answers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $parenId
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($parentId, $id)
    {
        $answer = Answer::find($id);

        if(empty($answer)) {
            flash('Resposta não encontrada!')->error();

            return redirect(route('answers.index', $parentId));
        }

        return view('pandoapps::answers.show', compact('answer'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $parenId
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($parentId, $id)
    {
        $answer = Answer::find($id);

        if(empty($answer)) {
            flash('Resposta não encontrada!')->error();

            return redirect(route('answers.index', $parentId));
        }

        return view('pandoapps::answers.edit', compact('answer'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $parenId
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($parentId, $id)
    {
        $answer = Answer::find($id);

        if(empty($answer)) {
            flash('Resposta não encontrada!')->error();

            return redirect(route('answers.index', $parentId));
        }

        $id = $answer->id;
        $answer->delete();

        flash('Resposta deletada com sucesso!')->success();

        return redirect(route('answers.index', $parentId));
    }
}
