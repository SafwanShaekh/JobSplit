
<div id="feedback-viewer-modal-{{ $application->id }}" class="feedback-viewer-overlay">
    <div class="feedback-viewer-content">
        
        {{-- Modal Header with New Design --}}
        <div class="feedback-viewer-header">
            <h5 class="heading5">Provide Feedback for {{ $application->user->name }}</h5>
            <button class="close-feedback-viewer-btn text-2xl text-secondary hover:text-primary">&times;</button>
        </div>

        {{-- Modal Body with Scrollbar --}}
        <div class="feedback-viewer-body">
            
            <form action="{{ route('feedback.store', $application) }}" method="POST">
                @csrf
                
                {{-- Yes/No Questions --}}
                <div class="feedback-question">
                    <p>1. Was the worker punctual?</p>
                    <div class="feedback-options"><label><input type="radio" name="q1" value="yes" required><span>Yes</span></label><label><input type="radio" name="q1" value="no"><span>No</span></label></div>
                </div>
                <div class="feedback-question">
                    <p>2. Was the work completed satisfactorily?</p>
                    <div class="feedback-options"><label><input type="radio" name="q2" value="yes" required><span>Yes</span></label><label><input type="radio" name="q2" value="no"><span>No</span></label></div>
                </div>
                <div class="feedback-question">
                    <p>3. Was the worker professional?</p>
                    <div class="feedback-options"><label><input type="radio" name="q3" value="yes" required><span>Yes</span></label><label><input type="radio" name="q3" value="no"><span>No</span></label></div>
                </div>
                <div class="feedback-question">
                    <p>4. Would you hire this worker again?</p>
                    <div class="feedback-options"><label><input type="radio" name="q4" value="yes" required><span>Yes</span></label><label><input type="radio" name="q4" value="no"><span>No</span></label></div>
                </div>
                <div class="feedback-question">
                    <p>5. Was the agreed price fair?</p>
                    <div class="feedback-options"><label><input type="radio" name="q5" value="yes" required><span>Yes</span></label><label><input type="radio" name="q5" value="no"><span>No</span></label></div>
                </div>

                {{-- Star Rating Component --}}
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

                {{-- Form Footer with Buttons --}}
                <div class="feedback-modal-footer">
                    <button type="button" class="btn btn-close close-feedback-viewer-btn">Cancel</button>
                    <button type="submit" class="btn btn-submit">Submit Feedback</button>
                </div>
            </form>
             </div>
    </div>
</div>

{{-- This CSS provides the new design and is self-contained in this file --}}
<style>
    .feedback-viewer-overlay {
        position: fixed; top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 9999;
        display: flex; align-items: center; justify-content: center;
        padding: 1rem;
        opacity: 0; visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    .feedback-viewer-overlay.visible {
        opacity: 1; visibility: visible;
    }
    .feedback-viewer-content {
        width: 90%; max-width: 600px; height: auto; max-height: 90vh;
        background-color: white; border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        display: flex; flex-direction: column;
        overflow: hidden;
        transform: scale(0.95); opacity: 0;
        transition: all 0.3s ease-in-out;
    }
    .feedback-viewer-overlay.visible .feedback-viewer-content {
        transform: scale(1); opacity: 1;
    }
    .feedback-viewer-header {
        padding: 1rem 1.5rem; border-bottom: 1px solid #e4e4e4;
        display: flex; justify-content: space-between; align-items: center;
        flex-shrink: 0;
    }
    .feedback-viewer-body {
        flex-grow: 1; overflow-y: auto; padding: 1.5rem;
    }
</style>

{{-- This script block contains BOTH the open/close and star rating functionality --}}
<script>
    // SCRIPT TO OPEN/CLOSE THIS MODAL
    document.addEventListener('DOMContentLoaded', function() {
        const openModalBtns = document.querySelectorAll('.open-feedback-modal-btn');
        openModalBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const modalId = btn.dataset.modalId;
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('visible');
                    const closeModalBtns = modal.querySelectorAll('.close-feedback-viewer-btn');
                    closeModalBtns.forEach(closeBtn => {
                        closeBtn.addEventListener('click', () => {
                            modal.classList.remove('visible');
                        });
                    });
                    modal.addEventListener('click', (event) => {
                        if (event.target === modal) {
                            modal.classList.remove('visible');
                        }
                    });
                }
            });
        });

        // SCRIPT FOR THE STAR RATING INTERACTIVITY
        const allStarComponents = document.querySelectorAll('.star-rating-component');
        allStarComponents.forEach(component => {
            const stars = component.querySelectorAll('.star');
            const ratingInput = component.querySelector('.rating-value-input');
            const ratingText = component.querySelector('.rating-text');
            let currentRating = 0;

            function updateStars(rating) {
                stars.forEach(star => {
                    star.classList.toggle('active', star.dataset.value <= rating);
                });
            }

            stars.forEach(star => {
                star.addEventListener('mouseover', () => updateStars(star.dataset.value));
                star.addEventListener('click', () => {
                    currentRating = star.dataset.value;
                    ratingInput.value = currentRating;
                    ratingText.textContent = `${currentRating} / 5`;
                    updateStars(currentRating);
                });
            });

            component.addEventListener('mouseleave', () => updateStars(currentRating));
        });
    });
</script>