<div>
    <div class="bg-blue-500 text-white rounded-t font-bold py-1">
        Reviews
    </div>
    <div class="bg-white rounded-b border-2 border-blue-500 py-1" id="review">
        <div class="px-3">
            <div class="NewReviewDiv my-3 hide">

                <div class='rating-stars text-center mb-2'>
                    <ul class="stars new cursor-pointer">
                    <li class='star' title='1' data-value='1'>
                        <i class='fa fa-star fa-fw'></i>
                    </li>
                    <li class='star' title='2' data-value='2'>
                        <i class='fa fa-star fa-fw'></i>
                    </li>
                    <li class='star' title='3' data-value='3'>
                        <i class='fa fa-star fa-fw'></i>
                    </li>
                    <li class='star' title='4' data-value='4'>
                        <i class='fa fa-star fa-fw'></i>
                    </li>
                    <li class='star' title='5' data-value='5'>
                        <i class='fa fa-star fa-fw'></i>
                    </li>
                    </ul>
                </div>

                <div class="reviewInput form-group mb-2 flex justify-between">
                    <input type="text" class="form-control border-gray-400 rounded" name="review">
                    <button class="btn btn-success btn-sm ml-2 font-bold" id="submitReview">Submit</button>
                </div>
                
                <span class="text-sm text-red-500 hide" id="reviewWarning">Please Rate this Product</span>
            </div>

            <div class="flex justify-between m-2">
                <div class="">
                    <span class="text-sm text-gray-600 font-bold min-w-max align-middle	" id='reviewCount'>
                        <span id="reviewsNum"> 50 </span> Reviews
                    </span>
                </div>
                <button class="btn btn-primary btn-sm font-bold" id='addReview'> + Add Review</button>
            </div>
            
            <div id="reviews">

            </div>

        </div>
            
    </div>
</div>