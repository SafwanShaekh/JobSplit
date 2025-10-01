{{-- ================================================================= --}}
{{-- === YEH MODAL AAPKI SAARI NOTIFICATIONS DIKHANE KE LIYE HAI === --}}
{{-- ================================================================= --}}

@auth
{{-- Nayi ID aur Class taake CSS conflict na ho --}}
<div id="notifications-viewer-modal" class="notifications-viewer-overlay">
    <div class="notifications-viewer-content">
        
        {{-- Modal Header --}}
        <div class="notifications-viewer-header">
            <h5 class="heading5">All Notifications</h5>
            <button id="close-notifications-viewer-modal" class="text-2xl text-secondary hover:text-primary">&times;</button>
        </div>

        {{-- Modal Body (Scrollable Area) --}}
        <div class="notifications-viewer-body">
            @forelse(Auth::user()->notifications as $notification)
                <div class="item p-3 border-b border-line flex items-start gap-3 {{ is_null($notification->read_at) ? 'bg-blue-50' : 'bg-white' }}">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center bg-surface flex-shrink-0 mt-1">
                        @if(Str::contains($notification->data['message'], 'Welcome'))
                            <i class="ph ph-user-plus text-lg text-green-500"></i>
                        @elseif(Str::contains($notification->data['message'], 'Approved'))
                             <i class="ph ph-check-circle text-lg text-green-500"></i>
                        @elseif(Str::contains($notification->data['message'], 'Rejected'))
                             <i class="ph ph-x-circle text-lg text-red-500"></i>
                        @else
                             <i class="ph ph-info text-lg text-secondary"></i>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm text-secondary">{{ $notification->data['message'] }}</p>
                        <span class="text-xs text-gray-400 mt-1 block">{{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-secondary">
                    <p>You have no notifications yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endauth

{{-- === FINAL GUARANTEED FIX: Self-Contained CSS with new IDs and !important rules === --}}
<style>
    .notifications-viewer-overlay {
        position: fixed; top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 9999;
        display: flex; align-items: center; justify-content: center;
        padding: 1rem;
        opacity: 0; visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    .notifications-viewer-overlay.visible {
        opacity: 1; visibility: visible;
    }

    .notifications-viewer-content {
        width: 90%;
        max-width: 550px;
        height: 75vh;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
        transform: scale(0.95);
        opacity: 0;
    }
    .notifications-viewer-overlay.visible .notifications-viewer-content {
        transform: scale(1); opacity: 1;
    }

    .notifications-viewer-header {
        padding: 1rem;
        border-bottom: 1px solid #e4e4e4;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-shrink: 0;
    }
    
    .notifications-viewer-body {
        flex-grow: 1;
        overflow-y: auto; /* Scrollbar sirf is hissay par aayega */
        padding: 0.5rem;
    }

    /* === BULLETPROOF SCROLLBAR STYLES === */
    
    /* For Firefox */
    .notifications-viewer-body {
        scrollbar-width: thin !important;
        scrollbar-color: #007bff #f1f1f1 !important;
    }
    /* For Chrome, Safari, and Edge */
    .notifications-viewer-body::-webkit-scrollbar {
        width: 8px !important;
    }
    .notifications-viewer-body::-webkit-scrollbar-track {
        background: #f1f1f1 !important;
        border-radius: 10px !important;
    }
    .notifications-viewer-body::-webkit-scrollbar-thumb {
        background-color: #007bff !important;
        border-radius: 10px !important;
        border: 2px solid #f1f1f1 !important;
    }
    .notifications-viewer-body::-webkit-scrollbar-thumb:hover {
        background: #0056b3 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('notifications-viewer-modal');
        const openModalBtn = document.getElementById('view-all-notifications-btn'); 
        const closeModalBtn = document.getElementById('close-notifications-viewer-modal');

        if (modal && openModalBtn && closeModalBtn) {
            openModalBtn.addEventListener('click', (event) => {
                event.preventDefault();
                modal.classList.add('visible');
            });

            closeModalBtn.addEventListener('click', () => {
                modal.classList.remove('visible');
            });

            modal.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.classList.remove('visible');
                }
            });
        }
    });
</script>

