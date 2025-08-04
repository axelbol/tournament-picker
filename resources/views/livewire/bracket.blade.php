<div>
    <div class="min-h-screen bg-gray-900 text-white p-8" wire:loading.class="opacity-50" wire:target="selectWinner">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold mb-4">Tournament Bracket</h1>
                <button wire:click="resetBracket" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded font-semibold transition-colors">
                    Reset Bracket
                </button>
            </div>

            @if($winner)
                <div class="text-center mb-8">
                    <div class="bg-yellow-600 text-black px-8 py-4 rounded-lg inline-block">
                        <h2 class="text-2xl font-bold">🏆 CHAMPION</h2>
                        <p class="text-xl">{{ $this->getTeamById($winner)['name'] }}</p>
                    </div>
                    <div class="mt-4">
                        <button onclick="downloadBracket()" class="bg-green-600 hover:bg-green-700 px-6 py-3 rounded-lg font-semibold transition-colors shadow-lg">
                            📸 Download Bracket
                        </button>
                    </div>
                </div>
            @endif

            <!-- Loading indicator -->
            <div wire:loading wire:target="selectWinner" class="fixed top-4 right-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg z-50">
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                    <span>Updating bracket...</span>
                </div>
            </div>

            <div class="bracket-container overflow-x-auto" id="bracket-content">
                <div class="flex justify-center space-x-12 min-w-max relative">

                    <!-- Round of 16 -->
                    <div class="flex flex-col justify-center space-y-6">
                        <h3 class="text-lg font-semibold text-center mb-4">Round of 16</h3>
                        @foreach($rounds['round16'] as $index => $match)
                            <div class="bg-gray-800 rounded-lg p-4 border border-gray-700 transition-all duration-200 hover:border-gray-600">
                                <div class="space-y-2">
                                    <!-- Team 1 -->
                                    <div class="flex items-center justify-between p-2 rounded cursor-pointer transition-all duration-150 transform hover:scale-105
                                        {{ $match['winner'] == $match['team1'] ? 'bg-green-600 shadow-lg' : 'bg-gray-700 hover:bg-gray-600' }}"
                                        wire:click="selectWinner({{ $match['match_id'] }}, {{ $match['team1'] }}, 'round16')" wire:loading.attr="disabled"
                                        wire:loading.class="opacity-50 cursor-not-allowed"
                                        wire:target="selectWinner">
                                        <span class="font-semibold">{{ $this->getTeamById($match['team1'])['code'] }}</span>
                                        @if($match['winner'] == $match['team1'])
                                            <span class="text-green-300 animate-bounce">✓</span>
                                        @endif
                                    </div>

                                    <!-- Team 2 -->
                                    <div class="flex items-center justify-between p-2 rounded cursor-pointer transition-all duration-150 transform hover:scale-105
                                        {{ $match['winner'] == $match['team2'] ? 'bg-green-600 shadow-lg' : 'bg-gray-700 hover:bg-gray-600' }}"
                                        wire:click="selectWinner({{ $match['match_id'] }}, {{ $match['team2'] }}, 'round16')" wire:loading.attr="disabled"
                                        wire:loading.class="opacity-50 cursor-not-allowed"
                                        wire:target="selectWinner">
                                        <span class="font-semibold">{{ $this->getTeamById($match['team2'])['code'] }}</span>
                                        @if($match['winner'] == $match['team2'])
                                            <span class="text-green-300 animate-bounce">✓</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Quarter Finals -->
                    <div class="flex flex-col justify-center space-y-12">
                        <h3 class="text-lg font-semibold text-center mb-4">Quarter Finals</h3>
                        @foreach($rounds['quarter'] as $index => $match)
                            <div class="bg-gray-800 rounded-lg p-4 border border-gray-700 transition-all duration-200 hover:border-gray-600">
                                <div class="space-y-2">
                                    <!-- Team 1 Slot -->
                                    @if($match['team1'])
                                        <div class="flex items-center justify-between p-2 rounded cursor-pointer transition-all duration-150 transform hover:scale-105
                                            {{ $match['winner'] == $match['team1'] ? 'bg-green-600 shadow-lg' : 'bg-gray-700 hover:bg-gray-600' }}"
                                            wire:click="selectWinner({{ $match['match_id'] }}, {{ $match['team1'] }}, 'quarter')" wire:loading.attr="disabled"
                                            wire:loading.class="opacity-50 cursor-not-allowed"
                                            wire:target="selectWinner">
                                            <span class="font-semibold">{{ $this->getTeamById($match['team1'])['code'] }}</span>
                                            @if($match['winner'] == $match['team1'])
                                                <span class="text-green-300 animate-bounce">✓</span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="p-2 rounded bg-gray-800 border border-dashed border-gray-600 text-gray-500 text-center">
                                            <span>TBD</span>
                                        </div>
                                    @endif

                                    <!-- Team 2 Slot -->
                                    @if($match['team2'])
                                        <div class="flex items-center justify-between p-2 rounded cursor-pointer transition-all duration-150 transform hover:scale-105
                                            {{ $match['winner'] == $match['team2'] ? 'bg-green-600 shadow-lg' : 'bg-gray-700 hover:bg-gray-600' }}"
                                            wire:click="selectWinner({{ $match['match_id'] }}, {{ $match['team2'] }}, 'quarter')" wire:loading.attr="disabled"
                                            wire:loading.class="opacity-50 cursor-not-allowed"
                                            wire:target="selectWinner">
                                            <span class="font-semibold">{{ $this->getTeamById($match['team2'])['code'] }}</span>
                                            @if($match['winner'] == $match['team2'])
                                                <span class="text-green-300 animate-bounce">✓</span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="p-2 rounded bg-gray-800 border border-dashed border-gray-600 text-gray-500 text-center">
                                            <span>TBD</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Semi Finals -->
                    <div class="flex flex-col justify-center space-y-20">
                        <h3 class="text-lg font-semibold text-center mb-4">Semi Finals</h3>
                        @foreach($rounds['semi'] as $index => $match)
                            <div class="bg-gray-800 rounded-lg p-4 border border-gray-700 transition-all duration-200 hover:border-gray-600">
                                <div class="space-y-2">
                                    <!-- Team 1 Slot -->
                                    @if($match['team1'])
                                        <div class="flex items-center justify-between p-2 rounded cursor-pointer transition-all duration-150 transform hover:scale-105
                                            {{ $match['winner'] == $match['team1'] ? 'bg-green-600 shadow-lg' : 'bg-gray-700 hover:bg-gray-600' }}"
                                            wire:click="selectWinner({{ $match['match_id'] }}, {{ $match['team1'] }}, 'semi')" wire:loading.attr="disabled"
                                            wire:loading.class="opacity-50 cursor-not-allowed"
                                            wire:target="selectWinner">
                                            <span class="font-semibold">{{ $this->getTeamById($match['team1'])['code'] }}</span>
                                            @if($match['winner'] == $match['team1'])
                                                <span class="text-green-300 animate-bounce">✓</span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="p-2 rounded bg-gray-800 border border-dashed border-gray-600 text-gray-500 text-center">
                                            <span>TBD</span>
                                        </div>
                                    @endif

                                    <!-- Team 2 Slot -->
                                    @if($match['team2'])
                                        <div class="flex items-center justify-between p-2 rounded cursor-pointer transition-all duration-150 transform hover:scale-105
                                            {{ $match['winner'] == $match['team2'] ? 'bg-green-600 shadow-lg' : 'bg-gray-700 hover:bg-gray-600' }}"
                                            wire:click="selectWinner({{ $match['match_id'] }}, {{ $match['team2'] }}, 'semi')" wire:loading.attr="disabled"
                                            wire:loading.class="opacity-50 cursor-not-allowed"
                                            wire:target="selectWinner">
                                            <span class="font-semibold">{{ $this->getTeamById($match['team2'])['code'] }}</span>
                                            @if($match['winner'] == $match['team2'])
                                                <span class="text-green-300 animate-bounce">✓</span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="p-2 rounded bg-gray-800 border border-dashed border-gray-600 text-gray-500 text-center">
                                            <span>TBD</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Final -->
                    <div class="flex flex-col justify-center">
                        <h3 class="text-lg font-semibold text-center mb-4">Final</h3>
                        @foreach($rounds['final'] as $index => $match)
                            <div class="bg-yellow-900 rounded-lg p-4 border border-yellow-600 transition-all duration-200 hover:border-yellow-500">
                                <div class="space-y-2">
                                    <!-- Team 1 Slot -->
                                    @if($match['team1'])
                                        <div class="flex items-center justify-between p-2 rounded cursor-pointer transition-all duration-150 transform hover:scale-105
                                            {{ $match['winner'] == $match['team1'] ? 'bg-yellow-600 text-black shadow-lg' : 'bg-gray-700 hover:bg-gray-600' }}"
                                            wire:click="selectWinner({{ $match['match_id'] }}, {{ $match['team1'] }}, 'final')" wire:loading.attr="disabled"
                                            wire:loading.class="opacity-50 cursor-not-allowed"
                                            wire:target="selectWinner">
                                            <span class="font-semibold">{{ $this->getTeamById($match['team1'])['code'] }}</span>
                                            @if($match['winner'] == $match['team1'])
                                                <span class="text-yellow-900 animate-bounce">🏆</span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="p-2 rounded bg-gray-800 border border-dashed border-gray-600 text-gray-500 text-center">
                                            <span>TBD</span>
                                        </div>
                                    @endif

                                    <!-- Team 2 Slot -->
                                    @if($match['team2'])
                                        <div class="flex items-center justify-between p-2 rounded cursor-pointer transition-all duration-150 transform hover:scale-105
                                            {{ $match['winner'] == $match['team2'] ? 'bg-yellow-600 text-black shadow-lg' : 'bg-gray-700 hover:bg-gray-600' }}"
                                            wire:click="selectWinner({{ $match['match_id'] }}, {{ $match['team2'] }}, 'final')" wire:loading.attr="disabled"
                                            wire:loading.class="opacity-50 cursor-not-allowed"
                                            wire:target="selectWinner">
                                            <span class="font-semibold">{{ $this->getTeamById($match['team2'])['code'] }}</span>
                                            @if($match['winner'] == $match['team2'])
                                                <span class="text-yellow-900 animate-bounce">🏆</span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="p-2 rounded bg-gray-800 border border-dashed border-gray-600 text-gray-500 text-center">
                                            <span>TBD</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Custom animations for better visual feedback */
    @keyframes winner-glow {
        0%, 100% {
            box-shadow: 0 0 5px rgba(34, 197, 94, 0.5);
        }
        50% {
            box-shadow: 0 0 20px rgba(34, 197, 94, 0.8);
        }
    }
    .bg-green-600 {
        animation: winner-glow 1s ease-in-out;
    }

    /* TBD styling */
    .border-dashed {
        border-style: dashed;
    }

    /* Print/Download optimizations */
    @media print {
        .fixed {
            position: absolute !important;
        }
        body {
            background: white !important;
        }
        .bg-gray-900 {
            background: white !important;
            color: black !important;
        }
    }

    /* Download-only elements (hidden by default) */
    .download-only {
        display: none;
    }
    </style>

    <!-- HTML2Canvas Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script>
        async function downloadBracket() {
            try {
                // Show loading state
                const button = event.target;
                const originalText = button.innerHTML;
                button.innerHTML = '📸 Generating...';
                button.disabled = true;

                // Get the bracket container
                const bracketElement = document.getElementById('bracket-content');

                // Create a wrapper div for the download image
                const downloadWrapper = document.createElement('div');
                downloadWrapper.style.cssText = `
                    position: relative;
                    background: #111827;
                    padding: 40px;
                    width: ${bracketElement.scrollWidth + 80}px;
                    height: ${bracketElement.scrollHeight + 140}px;
                `;

                // Create and add title
                const title = document.createElement('div');
                title.innerHTML = 'Tournament Axel Bracket';
                title.style.cssText = `
                    color: white;
                    font-size: 36px;
                    font-weight: bold;
                    text-align: center;
                    margin-bottom: 20px;
                    font-family: system-ui, -apple-system, sans-serif;
                `;

                // Clone the bracket content
                const clonedBracket = bracketElement.cloneNode(true);
                clonedBracket.style.cssText = `
                    overflow: visible;
                    margin: 0 auto;
                `;

                // Create watermark
                const watermark = document.createElement('div');
                watermark.innerHTML = '@axelbol';
                watermark.style.cssText = `
                    position: absolute;
                    bottom: 20px;
                    right: 20px;
                    color: #9ca3af;
                    font-size: 14px;
                    font-family: monospace;
                    opacity: 0.7;
                `;

                // Assemble the download content
                downloadWrapper.appendChild(title);
                downloadWrapper.appendChild(clonedBracket);
                downloadWrapper.appendChild(watermark);

                // Temporarily add to document (off-screen)
                downloadWrapper.style.position = 'absolute';
                downloadWrapper.style.left = '-9999px';
                downloadWrapper.style.top = '-9999px';
                document.body.appendChild(downloadWrapper);

                // Create canvas with high quality
                const canvas = await html2canvas(downloadWrapper, {
                    backgroundColor: '#111827', // gray-900
                    scale: 2, // Higher quality
                    useCORS: true,
                    allowTaint: false,
                    width: downloadWrapper.offsetWidth,
                    height: downloadWrapper.offsetHeight,
                    scrollX: 0,
                    scrollY: 0
                });

                // Remove the temporary wrapper
                document.body.removeChild(downloadWrapper);

                // Create download link
                const link = document.createElement('a');
                link.download = 'tournament-bracket-' + new Date().toISOString().split('T')[0] + '.png';
                link.href = canvas.toDataURL('image/png', 0.9);

                // Trigger download
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                // Reset button
                button.innerHTML = originalText;
                button.disabled = false;

                // Show success message
                showNotification('Bracket downloaded successfully! 🎉', 'success');

            } catch (error) {
                console.error('Error generating bracket image:', error);

                // Reset button
                const button = event.target;
                button.innerHTML = '📸 Download Bracket';
                button.disabled = false;

                showNotification('Failed to download bracket. Please try again.', 'error');
            }
        }

        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 left-1/2 transform -translate-x-1/2 px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 ${
                type === 'success' ? 'bg-green-600 text-white' :
                type === 'error' ? 'bg-red-600 text-white' :
                'bg-blue-600 text-white'
            }`;
            notification.textContent = message;

            // Add to page
            document.body.appendChild(notification);

            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translate(-50%, -20px)';
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }
    </script>
</div>
