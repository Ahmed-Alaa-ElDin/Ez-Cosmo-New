<div>
    <div class="bg-blue-500 text-white rounded-t font-bold py-1">
        Reviews
    </div>
    <div class="bg-white rounded-b border-2 border-blue-500 py-1" id="review">
        <div class="px-3">
            <div class="NewReviewDiv my-3 
                @if (!$showReviewAdd) hide @endif ">

                <div class='rating-stars text-center mb-2'>
                    <ul class=" stars new cursor-pointer">
                <li class='star @if ($score >= 1) selected @endif'
                    title='1' data-value='1' wire:click="star(1)">
                    <i class='fa fa-star fa-fw '></i>
                </li>
                <li class='star @if ($score >= 2) selected @endif'
                    title='2' data-value='2' wire:click="star(2)">
                    <i class='fa fa-star fa-fw'></i>
                </li>
                <li class='star @if ($score >= 3) selected @endif'
                    title='3' data-value='3' wire:click="star(3)">
                    <i class='fa fa-star fa-fw'></i>
                </li>
                <li class='star @if ($score >= 4) selected @endif'
                    title='4' data-value='4' wire:click="star(4)">
                    <i class='fa fa-star fa-fw'></i>
                </li>
                <li class='star @if ($score >= 5) selected @endif'
                    title='5' data-value='5' wire:click="star(5)">
                    <i class='fa fa-star fa-fw'></i>
                </li>
                </ul>
            </div>

            <div class="reviewInput form-group mb-2 flex justify-between">
                <input type="text" class="form-control border-gray-400 rounded" wire:model.lazy="review">
                <button class="btn btn-success btn-sm ml-2 font-bold" id="submitReview"
                    wire:click="save">Submit</button>
            </div>

            @error('score')
                <span class="text-sm text-red-500 mb-2 font-bold inline-block">Please Choose Score for this Product First</span>
            @enderror
            <hr>
        </div>

        <div class="flex justify-between m-2">
            <div>
                <span class="text-sm text-gray-600 font-bold min-w-max align-middle" id='reviewCount'>
                    <span id="reviewsNum">
                        @if ($reviewsCount >= 0)
                            @if ($reviewsCount >= 2)
                                {{ $reviewsCount }} Reviews
                            @elseif ($reviewsCount == 1)
                                {{ $reviewsCount }} Review
                            @else
                                No Reviews Yet
                            @endif
                        @endif
                    </span>
                </span>
                <div>
                    @if ($avgRate)
                        <div class="review">
                            <div class='rating-stars mr-2'>
                                <ul class="stars">
                                    <li class='star selected' title='1' data-value='1'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star @if ($avgRate->avg_score >= 1.5) selected @endif'
                                        title='2' data-value='2'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star @if ($avgRate->avg_score >= 2.5) selected @endif'
                                        title='3' data-value='3'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star @if ($avgRate->avg_score >= 3.5) selected @endif'
                                        title='4' data-value='4'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star @if ($avgRate->avg_score >= 4.5) selected @endif'
                                        title='5' data-value='5'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                </ul>
                            </div>
                            <div class="text-sm font-bold">
                                <span class="align-middle">

                                    {{ number_format($avgRate->avg_score, 1) }}
                                    ({{ $avgRate->no_reviewers }})
                                </span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @if ($canAddReview)
                <div class="self-center">
                    <button class="btn btn-primary btn-sm font-bold align-middle @if ($showReviewAdd) hide @endif" id='addReview' wire:click='reviewAdd'>
                        + Add
                        Review</button>
                </div>
            @endif
        </div>

        <div id="reviews">
            @foreach ($reviews as $review)
                <hr>
                <div class="p-2 reviewParent">
                    <div class="flex justify-between">
                        <div class="userName font-bold">
                            {{ $review->user->first_name }} {{ $review->user->last_name }}
                        </div>
                        <div class="reviewDate text-gray-400 font-bold text-sm">
                            @if ($review->created_at)
                                {{ $review->created_at->diffForHumans() }}
                            @endif
                            @if ($review->user->id == Auth::user()->id || Auth::user()->hasAnyRole('Super Admin|Admin|Sub Admin'))
                                <button
                                    class="btn btn-danger btn-sm px-1 py-0 font-bold text-sm ml-3 deleteReviewButton"
                                    title="Delete Review" data-id='{{ $review->id }}' data-toggle="modal"
                                    data-target="#DeleteReviewModal"
                                    wire:click="$set('review_id', {{ $review->id }})"><i
                                        class="fas fa-minus fa-fw"></i></button>
                            @endif
                        </div>
                    </div>
                    <div class='rating-stars text-center'>
                        <ul class="stars">
                            <li
                                class='star @if ($review->score >= 1) selected @endif'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li
                                class='star @if ($review->score >= 2) selected @endif'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li
                                class='star @if ($review->score >= 3) selected @endif'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li
                                class='star @if ($review->score >= 4) selected @endif'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li
                                class='star @if ($review->score >= 5) selected @endif'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                        </ul>
                    </div>
                    <div class="reviewText my-2">
                        {{ $review->review }}
                    </div>
                </div>

                @if ($loop->last)
                    <hr>
                @endif
            @endforeach

            @if ($reviews->count())

                <div class="flex justify-between my-2">
                    <div class="text-sm font-bold self-center ">
                        Showing {{ $reviews->firstItem() }} to {{ $reviews->lastItem() }} of
                        {{ $reviews->total() }}
                        reviews
                    </div>
                    <div>
                        {{ $reviews->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>

</div>
<!-- Delete Review Modal -->
<div class="modal fade" id="DeleteReviewModal" tabindex="-1" role="dialog"
    aria-labelledby="deleteReviewModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-black font-bold">
                <h5 class="modal-title" id="deleteReviewModalCenterTitle">Deleting Review Confirmation</h5>
                <button type="button" class="close closeButton" onclick="$('#DeleteReviewModal').modal('hide');"
                    aria-label="Close" wire:click="$emit('modalOpen')">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                Are You Sure, You Want To Delete This Review ?
            </div>
            <div class="modal-footer flex justify-between">
                <button type="button" class="btn btn-secondary font-bold closeButton"
                    onclick="$('#DeleteReviewModal').modal('hide');" wire:click="$emit('modalOpen')">Cancel</button>
                <button type="button" class="btn btn-danger font-bold" onclick="$('#DeleteReviewModal').modal('hide');"
                    wire:click="removeReview({{ $review_id }})">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete Review Modal -->


</div>
