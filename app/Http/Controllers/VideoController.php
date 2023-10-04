<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnswerFeedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function recordVideo(Request $request)
    {
        try {
            // Get the uploaded video file from the request
            $videoFile = $request->file('video');
            $answerId = $request->input('answerId');

            // Generate a unique filename for the video
            $filename = uniqid() . '_interview_recording.webm';

            // Store the video file in the public/videos directory
            $videoFile->move(public_path('videos'), $filename);

            $videoPath = 'videos/' . $filename;

            // Find the specific record by primary key
            $answerFeedback = AnswerFeedback::find($answerId);

            if ($answerFeedback) {
                // Update the video_path for the found record
                $answerFeedback->update(['video_path' => $videoPath]);
                return redirect()->route('candidate.home')->with('success', 'Interview Complete');
            } else {
                return response()->json(['message' => 'AnswerFeedback record not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error uploading video'], 500);
        }
    }

}
