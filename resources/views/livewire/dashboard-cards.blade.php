<div>
<div class="bg-white shadow">
    <div class="px-4 sm:px-6 lg:mx-auto lg:max-w-6xl lg:px-8">
      <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
        <div class="min-w-0 flex-1">
          <!-- Profile -->
          <div class="flex items-center">
            <img class="hidden h-16 w-16 rounded-full sm:block" src="{{ $user->image ? $user->image : 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541' }}" alt="User profile picture">
            <div>
              <div class="flex items-center">
                <img class="h-16 w-16 rounded-full sm:hidden" src="{{ $user->image ? $user->image : 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541' }}" alt="User profile picture">

                @if ($user->firstname)
                <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:leading-9">
                  Bienvenue à nouveau {{ $user->firstname }}
                </h1>
                @else
                <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:leading-9">
                  Bienvenue à nouveau {{ $user->username }}
                </h1>
                @endif
              </div>
              <dl class="mt-6 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap">
                <dt class="sr-only">Address</dt>
                <dd class="flex items-center text-sm font-medium capitalize text-gray-500 sm:mr-6">
                  <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M4 16.5v-13h-.25a.75.75 0 010-1.5h12.5a.75.75 0 010 1.5H16v13h.25a.75.75 0 010 1.5h-3.5a.75.75 0 01-.75-.75v-2.5a.75.75 0 00-.75-.75h-2.5a.75.75 0 00-.75.75v2.5a.75.75 0 01-.75.75h-3.5a.75.75 0 010-1.5H4zm3-11a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1zM7.5 9a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5h-1zM11 5.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1zm.5 3.5a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5h-1z" clip-rule="evenodd" />
                  </svg>
                  @if ($user->firstname)
                  {{ $user->address }}
                  @else
                  Address
                  @endif
                </dd>
                <dt class="sr-only">Account status</dt>
                <dd class="mt-3 flex items-center text-sm font-medium capitalize text-gray-500 sm:mr-6 sm:mt-0">
                  <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-emerald-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                  </svg>
                  Compte verifié
                </dd>
              </dl>
            </div>
          </div>
        </div>
        <div class="mt-6 flex space-x-3 md:ml-4 md:mt-0">
          <a href="{{route('inputevent')}}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Ajouter publication</a>
          <a href="{{route('events')}}" class="inline-flex items-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Toutes les publications</a>
        </div>
      </div>
    </div>
</div>
<div class="mt-8">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
      <h2 class="text-lg font-medium leading-6 text-gray-900">Vue d'ensemble</h2>
      <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-2">
        <!-- Card 1: Total Users (visible only if the user has permission) -->
        @if($user->can('Lire Utilisateur'))
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="absolute rounded-md bg-emerald-500 p-3">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500">Total des inscrits</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers }} Utilisateurs</p>
                    <p class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                        <svg class="h-5 w-5 flex-shrink-0 self-center text-green-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Increased by</span>
                        {{ $usersThisWeek }}
                        <span class="ml-1 text-xs">cette semaine</span>
                    </p>
                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-emerald-600 hover:text-emerald-500">Tous les utilisateurs<span class="sr-only">Total Subscribers stats</span></a>
                        </div>
                    </div>
                </dd>
            </div>
        @endif
    
        <!-- Card 2: User's Events -->
        <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
            <dt>
                <div class="absolute rounded-md bg-emerald-500 p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.022.55m0 0l-4.661 2.51m16.5 1.615a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V8.844a2.25 2.25 0 011.183-1.98l7.5-4.04a2.25 2.25 0 012.134 0l7.5 4.04a2.25 2.25 0 011.183 1.98V19.5z" />
                    </svg>
                </div>
                <p class="ml-16 truncate text-sm font-medium text-gray-500">Total des publications</p>
            </dt>
            <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                <p class="text-2xl font-semibold text-gray-900">{{ $totalEvents }} Publications</p>
                <p class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                    <svg class="h-5 w-5 flex-shrink-0 self-center text-green-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Increased by</span>
                    {{ $eventsThisWeek }}
                    <span class="ml-1 text-xs">cette semaine</span>
                </p>
                <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                    <div class="text-sm">
                        <a href="{{route('events')}}" class="font-medium text-emerald-600 hover:text-emerald-500">Toutes les publications<span class="sr-only">Avg. Open Rate stats</span></a>
                    </div>
                </div>
            </dd>
        </div>
    
        <!-- Conditionally Displayed Chart for Users with Events (if user has permission) -->
        @if($user->can('Lire Utilisateur'))
            <div class="rounded-lg shadow-md overflow-hidden w-full md:flex" style="max-width:900px" x-data="{chartData: { labels: ['Utilisateurs actifs', 'Utilisateurs inactifs'], datasets: [{ data: [{{ $percentageUsersWithEvents }}, {{ 100 - $percentageUsersWithEvents }}], backgroundColor: ['#10b981', '#F44336'] }]}, renderChart: function() { let ctx = document.getElementById('chart').getContext('2d'); new Chart(ctx, { type: 'pie', data: this.chartData, options: { responsive: true, maintainAspectRatio: false, } }); }}" x-init="renderChart()">
                <div class="flex w-full md:w-1/2 px-5 pb-4 pt-8 bg-white text-white items-center">
                    <canvas id="chart" class="w-full text-white"></canvas>
                </div>
                <div class="flex w-full md:w-1/2 p-10 bg-white text-gray-600 items-center">
                    <div class="w-full">
                        <h3 class="text-md font-semibold leading-tight text-gray-800">Statistiques / utilisateur</h3>
                        <h6 class="text-sm leading-tight mt-3 mb-2">Pourcentage</h6>
                        <div class="flex w-full items-end mb-6">
                            <span class="block leading-none font-semibold text-3xl text-emerald-500">{{ number_format($percentageUsersWithEvents, 2) }}%</span>
                        </div>
                        <h6 class="text-sm leading-tight mb-2">Moyenne</h6>
                        <div class="flex w-full items-end mb-6">
                            <span class="block leading-none font-semibold text-3xl text-emerald-500">{{ number_format($averageEventsPerUser, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    
        <!-- Card 3: Confirmed and Unconfirmed Events -->
        <div class="rounded-lg shadow-md overflow-hidden w-full md:flex" style="max-width:900px" x-data="{ chartData: { labels: ['Approuvées', 'En attente'], datasets: [{ data: [{{ $confirmedEvents }}, {{ $unconfirmedEvents }}], backgroundColor: ['#10b981', '#F44336'] }] }, renderChart: function() { let ctx = document.getElementById('confirmedUnconfirmedChart').getContext('2d'); new Chart(ctx, { type: 'polarArea', data: this.chartData, options: { responsive: true, maintainAspectRatio: false, } }); } }" x-init="renderChart()">
            <div class="flex w-full md:w-1/2 px-5 pb-4 pt-8 bg-white items-center">
                <canvas id="confirmedUnconfirmedChart" class="w-1/2"></canvas>
            </div>
            <div class="flex w-full md:w-1/2 p-10 bg-white text-gray-600 items-center">
                <div class="w-full">
                    <h3 class="text-md font-semibold leading-tight text-gray-800">Statut des publications</h3>
                    <div class="flex w-full mt-8 items-end mb-6">
                        <span class="block leading-none font-semibold text-xl text-emerald-500">{{ $confirmedEvents }} Approuvées</span>
                    </div>
                    <div class="flex w-full items-end mb-6">
                        <span class="block leading-none font-semibold text-xl text-red-500">{{ $unconfirmedEvents }} En attente</span>
                    </div>
                </div>
            </div>
        </div>
    </dl>

    
    
    
    </div>

  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
</div>
