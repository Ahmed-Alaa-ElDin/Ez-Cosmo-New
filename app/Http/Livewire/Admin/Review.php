<?php

namespace App\Http\Livewire\Admin;

use App\Models\Review as ReviewModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Review extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['reviewAdd', 'canAddReview'];

    // Variables
    public $product_id, $review_id;
    public $showReviewAdd = false;
    public $review;
    public $score = 0;
    public $canAddReview = true;

    // Initiation of Review Component
    public function render()
    {
        $reviews = ReviewModel::with('user')->where('product_id', $this->product_id)->orderBy('created_at', 'DESC')->paginate(10);

        $reviewsCount = ReviewModel::with('user')->where('product_id', $this->product_id)->orderBy('created_at', 'DESC')->count() ?: 0;

        $avgRate = ReviewModel::where('product_id', $this->product_id)->select('product_id', DB::raw("SUM(`score`) / COUNT(`score`) AS `avg_score`"), DB::raw("COUNT(`score`) AS `no_reviewers`"))->groupBy('product_id')->orderBy('avg_score', 'DESC')->first();

        $user = ReviewModel::where('user_id', Auth::user()->id)->where('product_id', $this->product_id)->count();

        if ($user > 0) {
            $this->canAddReview = false;
        }

        return view('livewire.admin.products.review', compact('reviews', 'avgRate', 'reviewsCount'));
    }

    
    // Set Score Value
    public function star($score)
    {
        $this->score = $score;
    }


    // Add New Review
    public function save()
    {
        $this->validate(['score' => 'required|numeric|min:1']);

        ReviewModel::create([
            'review' => $this->review,
            'score' => $this->score,
            'user_id' => Auth::user()->id,
            'product_id' => $this->product_id
        ]);

        $this->showReviewAdd = false;
        $this->canAddReview = false;
        $this->score = 0;
        $this->reset(['review']);
        $this->emit('success', ['type' => 'success', 'message' => "Your Review Added Successfully."]);
    }

    public function reviewAdd()
    {
        $this->showReviewAdd = true;
    }

    public function canAddReview()
    {
        $this->canAddReview = false;
    }

    // Remove Review
    public function removeReview($review_id)
    {
        ReviewModel::findOrFail($review_id)->delete();

        $this->emit('success', ['type' => 'success', 'message' => "Your Review Deleted Successfully."]);
        $this->emit('modalOpen');
        $this->canAddReview = true;
    }
}
