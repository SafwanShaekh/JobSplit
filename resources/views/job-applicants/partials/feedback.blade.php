

<div id="feedbackModal-{{ $application->id }}" class="modal">
    <div class="modal_item">

        <div class="feedback-modal-header">
            <h3>Provide Feedback for {{ $application->user->name }}</h3>
        </div>

        <form action="{{ route('feedback.store', $application) }}" method="POST">
            @csrf
            <div class="feedback-modal-body">
                <div class="feedback-question">
                    <p>1. Was the worker punctual?</p>
                    <div class="feedback-options">
                        <label><input type="radio" name="q1" value="yes" required><span>Yes</span></label>
                        <label><input type="radio" name="q1" value="no"><span>No</span></label>
                    </div>
                </div>

                <div class="feedback-question">
                    <p>2. Was the work completed satisfactorily?</p>
                    <div class="feedback-options">
                        <label><input type="radio" name="q2" value="yes" required><span>Yes</span></label>
                        <label><input type="radio" name="q2" value="no"><span>No</span></label>
                    </div>
                </div>

                <div class="feedback-question">
                    <p>3. Was the worker professional?</p>
                    <div class="feedback-options">
                        <label><input type="radio" name="q3" value="yes" required><span>Yes</span></label>
                        <label><input type="radio" name="q3" value="no"><span>No</span></label>
                    </div>
                </div>

                <div class="feedback-question">
                    <p>4. Would you hire this worker again?</p>
                    <div class="feedback-options">
                        <label><input type="radio" name="q4" value="yes" required><span>Yes</span></label>
                        <label><input type="radio" name="q4" value="no"><span>No</span></label>
                    </div>
                </div>

                <div class="feedback-question">
                    <p>5. Was the agreed price fair?</p>
                    <div class="feedback-options">
                        <label><input type="radio" name="q5" value="yes" required><span>Yes</span></label>
                        <label><input type="radio" name="q5" value="no"><span>No</span></label>
                    </div>
                </div>
            </div>
                        {{-- Replace your old star rating HTML with this new version --}}
            <div class="mt-6">
                <h4 class="text-lg font-semibold">Rate</h4>

                <div class="star-rating-component flex items-center space-x-1 mt-2">

                    <span class="star" data-value="1">★</span>
                    <span class="star" data-value="2">★</span>
                    <span class="star" data-value="3">★</span>
                    <span class="star" data-value="4">★</span>
                    <span class="star" data-value="5">★</span>

                    <input type="hidden" name="rating" class="rating-value-input" value="0">

                    <span class="rating-text ml-4 text-gray-500">No rating</span>
                </div>
            </div>

            <div class="feedback-modal-footer">
                <button type="button" onclick="closeModal('feedbackModal-{{ $application->id }}')" class="btn btn-close">Cancel</button>
                <button type="submit" class="btn btn-submit">Submit Feedback</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Find all star rating components on the page
        const allStarComponents = document.querySelectorAll('.star-rating-component');

        // Set up the logic for each one individually
        allStarComponents.forEach(component => {
            const stars = component.querySelectorAll('.star');
            const ratingInput = component.querySelector('.rating-value-input');
            const ratingText = component.querySelector('.rating-text');
            
            let currentRating = 0;

            // Function to update the star visuals for this specific component
            function updateStars(rating) {
                stars.forEach(star => {
                    if (star.dataset.value <= rating) {
                        star.classList.add('active');
                    } else {
                        star.classList.remove('active');
                    }
                });
            }

            stars.forEach(star => {
                star.addEventListener('mouseover', () => {
                    updateStars(star.dataset.value);
                });

                star.addEventListener('click', () => {
                    currentRating = star.dataset.value;
                    ratingInput.value = currentRating; // This now updates the correct input
                    ratingText.textContent = `${currentRating} / 5`;
                    updateStars(currentRating);
                });
            });

            component.addEventListener('mouseleave', () => {
                updateStars(currentRating);
            });
        });
    });
</script>

