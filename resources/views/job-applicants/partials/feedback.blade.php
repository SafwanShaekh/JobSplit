

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

            <div class="feedback-modal-footer">
                <button type="button" onclick="closeModal('feedbackModal-{{ $application->id }}')" class="btn btn-close">Cancel</button>
                <button type="submit" class="btn btn-submit">Submit Feedback</button>
            </div>
        </form>
    </div>
</div>