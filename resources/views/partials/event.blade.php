
                  <div class="-mt-2">
                    @if(empty($items))
                      <div class="md:hidden mt-20 font-bold text-lg text-center">
                        <span class="text-emerald-500">Il n'y a aucun événement ce jour-là, vérifiez l'entrée en haut pour les autres jours vus ou </span>
                        <a id="right-arrow2" class="text-gray-500">cliquez ici</a>
                        <span class="text-emerald-500">pour vous déplacer au jour suivant</span>
                      </div>
                      @else
                      @foreach ($items as $item)
                      {{-- debut du post --}}
                      <article class="flex flex-col lg:flex-row pb-6 my-5 md:pt-6 pl-0 sm:px-2 drop-shadow-md rounded-lg lg:px-4 bg-white">
                        <div class="flex flex-col-reverse lg:flex-row lg:w-6/12">
                            <div class="md:-ml-[14px] mb-2 mx-2 mt-2 md:mt-0 flex flex-row lg:flex-col justify-between">
                              <div class="-mt-1">
                              <livewire:like-button wire:key :event-id="$item['event']->id" />
                              </div>
                            <a target="_blank" href="{{ $item['event']->link }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class=" ml-3 mr-1" width="60" height="60" viewBox="0 1 15 15">
                                <path fill="#888888" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                              </svg>
                            </a>
                            <div x-cloak x-data="{ isModalOpen: false }" >
                              <button @click="isModalOpen = true">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="ml-3 mr-1" width="34" height="50" viewBox="0 0 16 16">
                                      <path fill="#888888" d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                      <path fill="#888888" d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                  </svg>
                              </button>
                              <div x-cloak x-show="isModalOpen" class="absolute inset-0 z-40 bg-white bg-opacity-75 transition-opacity" style="display: none;">
                                  <div class="absolute inset-0 z-10 md:ml-5 md:-mt-1">
                                      <div class="flex min-h-full min-w-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                          <div class="absolute transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                                              <p class="text-lg font-bold tracking-tight text-gray-900 pb-4 sm:text-lg">Description</p>
                                              <p class="text-md w-auto md:w-full font-semibold tracking-tight text-gray-700 pb-4 sm:text-md">{{ substr($item['event']->content, 0, 420) }}...</p>
                                              <button @click="isModalOpen = false" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                                  Annuler
                                              </button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div X-cloak x-data="{ isModalOpen: false }">
                            <button @click="isModalOpen = true">
                                <svg xmlns="http://www.w3.org/2000/svg" class=" ml-3 mr-1" width="32" height="32" viewBox="0 0 16 16">
                                  <path fill="#888888" d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                                </svg>
                              </button>
                              <div x-cloak x-show="isModalOpen" class="absolute inset-0 z-40 bg-white bg-opacity-75 transition-opacity">
                                <div class="absolute inset-0 z-10 md:ml-5 md:-mt-1">
                                  <div class="flex min-h-full min-w-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                    <div class="absolute min-w-full md:min-w-0 transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-3 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                                      <div class="my-4">
                                        <p class="text-sm mt-4 md:mt-0">Partager ce lien via</p>
                                
                                        <div class="flex my-2 items-center justify-start">
                                          <!--FACEBOOK ICON-->
                                          <a rel="noreferrer" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('show', [$item['type'], $item['id']]) }}&title={{ $item['event']->title }}" class="text-gray-600 hover:text-[#1877f2]">
                                            <span class="sr-only">Facebook</span>
                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                              <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.503 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                            </svg>
                                          </a>
                                          <a href="https://twitter.com/intent/tweet?url={{ route('show', [$item['type'], $item['id']]) }}&text={{ $item['event']->title }}" rel="noreferrer" target="_blank" class="text-gray-600 hover:text-[#1d9bf0] ml-2">
                                            <span class="sr-only">X</span>
                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                              <path d="M13.6823 10.6218L20.2391 3H18.6854L12.9921 9.61788L8.44486 3H3.2002L10.0765 13.0074L3.2002 21H4.75404L10.7663 14.0113L15.5685 21H20.8131L13.6819 10.6218H13.6823ZM11.5541 13.0956L10.8574 12.0991L5.31391 4.16971H7.70053L12.1742 10.5689L12.8709 11.5655L18.6861 19.8835H16.2995L11.5541 13.096V13.0956Z" />
                                            </svg>
                                          </a>
                                          <a href="https://api.whatsapp.com/send?text={{$item['event']->title}}%3A%20%0A{{ route('show', [$item['type'], $item['id']]) }}" rel="noreferrer" target="_blank" class="text-gray-600 hover:text-[#25D366] ml-3">
                                            <span class="sr-only">whatsapp</span>
                                            <svg fill="currentColor" aria-hidden="true" viewBox="0 0 24 24" class="h-[21px] w-[21px]">             
                                              <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"></path>
                                            </svg>
                                          </a>
                                        </div>
                                      </div>
                                
                                      <div class="my-4 w-full flex gap-2">
                                        <input type="text" id="link-input" class="my-1 py-1 w-full col-span-4 rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" value="{{ route('show', [$item['type'], $item['id']]) }}" readonly>
                                        <button onclick="copyLink()" class="mt-1 px-4 my-1 py-1 text-base font-medium sm:text-sm bg-emerald-500 text-white rounded-md hover:bg-emerald-600">Copier</button>
                                      </div>
                                
                                      <div class="my-4">
                                        <button @click="isModalOpen = false" type="button" class="inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 sm:text-sm">
                                          Annuler
                                        </button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
                                <script>
                                  function copyLink() {
                                    var copyText = document.getElementById("link-input");
                                    copyText.select();
                                    copyText.setSelectionRange(0, 99999); // For mobile devices
                                    navigator.clipboard.writeText(copyText.value);
                                    
                                    var message = document.createElement("div");
                                    message.innerText = "Copied successfully";
                                    message.style.position = "fixed";
                                    message.style.bottom = "20px";
                                    message.style.right = "20px";
                                    message.style.padding = "10px";
                                    message.style.backgroundColor = "#059669";
                                    message.style.color = "#fff";
                                    message.style.borderRadius = "5px";
                                    message.style.zIndex = "1000";
                                    document.body.appendChild(message);
                                
                                    setTimeout(function() {
                                      message.remove();
                                    }, 1000);
                                  }
                                </script>
                                
                              </div>  
                 
                            </div>
              
                            </div>
                            <a href="{{ route('show', [$item['type'], $item['id']]) }}">
                                 <img class="w-full max-h-full object-cover pt-0 lg:max-h-none lg:h-60 rounded-md lg:rounded-lg  aspect-[16/9] sm:aspect-[2/1] lg:aspect-[16/6]" src="{{ asset('storage/' . ($item['event']->image ?? 'default.jpg')) }}">
                            </a>
                        </div>
                        <div class="flex flex-col items-start space-y-[7px] lg:w-6/12 lg:mt-0 md:pl-4 md:ml-4">
                                  <div class=" flex flex-wrap gap-2 pl-2 lg:pl-0">
                                    @if ($item['event']->menu)
                                    <a
                                    href="{{ route('menus.index', ['id' => $item['event']->menu->id]) }}"
                                    class=" bg-green-500 text-white px-2 py-1 md:text-sm font-semibold rounded-md" href="">
                                    {{ $item['event']->menu->name }}
                                    </a>
                                    @endif
                                    @if ($item['event']->type)
                                    <a href="{{ route('index', array_merge(request()->query(), ['type_id' => $item['event']->type->id])) }}" 
                                       class="bg-green-500 text-white px-2 py-1 md:text-sm font-semibold rounded-md">
                                        {{ $item['event']->type->name }}
                                    </a>
                                @endif
                                @if ($item['event']->subtype)
                                    <a href="{{ route('index', array_merge(request()->query(), ['subtype_id' => $item['event']->subtype->id])) }}" 
                                       class="bg-green-500 text-white mr-2 px-2 py-1 md:text-sm font-semibold rounded-md">
                                        {{ $item['event']->subtype->name }}
                                    </a>
                                @endif
                                    @if ($item['latitude'])
                                    <a target="_blank" href="http://maps.google.com/maps?q={{ $item['latitude'] }},{{ $item['longitude'] }}+(My+Point)&z=14&ll={{ $item['latitude'] }},{{ $item['longitude'] }}">
                                      <div class="w-8 h-8 md:hidden flex items-center justify-center rounded-md border border-green-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 6.9 8 11.7z"/></svg>
                                    </div>
                                  </a>
                                  @endif
                                  </div>
              
                          <a href="{{ route('show', [$item['type'], $item['id']]) }}">
                            <p class="font-bold block text-slate-900 text-xl lg:text-2xl leading-tight pl-2 lg:pl-0">{{ $item['event']->title }}</p>
                          </a>
                            @if ($item['event']->subtitle)
                            <p class="text-md w-full block md:text-lg text-gray-800 pl-2 lg:pl-0">
                              {{ $item['event']->subtitle }}          
                            </p>
                            @endif
                            
                            @if (!$item['hide'])
                            @php
                                \Carbon\Carbon::setLocale('fr');
                                $dateEnd = $item['dateend'] ? \Carbon\Carbon::parse($item['dateend'])->format('d/m/Y') : null;
                                $dateStart = \Carbon\Carbon::parse($item['datestart'])->translatedFormat('l d/m/Y');
                            @endphp
                        
                            @if ($dateEnd)
                                <p class="text-md w-full block font-bold md:text-lg text-gray-700 pl-2 lg:pl-0">
                                    {{ $dateStart ? 'Du ' . $dateStart . ' au ' . $dateEnd : 'Le ' . $dateEnd }}
                                </p>
                            @else
                                <p class="text-md w-full block font-bold md:text-lg text-gray-700 pl-2 lg:pl-0">
                                    {{ 'Le ' . $dateStart }}
                                </p>
                            @endif
                        
                            @php
                                $time = '';
                                if (isset($item['datestart'])) {
                                    try {
                                        $time = \Carbon\Carbon::parse($item['datestart'])->format('H:i');
                                    } catch (\Exception $e) {
                                        // Handle the error if needed
                                        $time = '';
                                    }
                                }
                            @endphp
                        
                            <p class="text-base w-full block font-bold md:text-lg text-gray-700 pl-2 lg:pl-0">
                                À {{ $time }}
                            </p>
                        @endif
                        
                        @if (isset($item['city']) && $item['city'])          
                        <div class="pl-2 flex items-start lg:pl-0">
                            <a href="{{ url('/?search=&city=' .  $item['city']  . '&date=&sort=ds') }}" 
                               class="text-md md:text-lg font-semibold flex text-black underline">
                               {{ $item['city'] }}
                            </a>
                            <span class="text-md mt-[3px] md:text-lg flex text-black">&nbsp;&nbsp;</span>
                            <span class="flex mt-[3px]">{{ $item['address'] }}</span>
                        </div>
                        @else
                            <a class="text-md md:text-lg text-black underline pl-2 lg:pl-0">
                              Virtuelle
                            </a>
                            @endif
                          <div  class=" flex justify-start items-center relative bg-yellow-200 z-20 px-2 ml-2 lg:ml-0 gradient-bg blur-sm bg-opacity-75">
                            @if ($item['prices']->isEmpty())
                          <p class="text-md md:text-lg item-center font-bold text-yellow-200 pl-2 lg:pl-0">
                            Gratuit
                          </p>
                          @elseif ($item['prices']->count() == 1)
                          <p class="text-md md:text-lg item-center font-bold text-yellow-200 pl-2 lg:pl-0">
                            A partir de : {{ $item['prices'][0]->pivot->cost }} MAD
                          </p>
                          @else
                          <button class="text-md md:text-lg font-bold  text-yellow-200 pl-2 lg:pl-0">
                            A partir de : {{ $item['lowest_cost'] }} MAD
                          </button>

                          @endif
                        </div>
                          <div x-data="{ open: false }" class="flex z-30 px-2">
                            @if ($item['prices']->isEmpty())
                          <p class="text-md md:text-lg -mt-8 md:-mt-9 font-bold text-black pl-2 lg:pl-0">
                            Gratuit
                          </p>
                          @elseif ($item['prices']->count() == 1)
                          <p class="text-md md:text-lg -mt-8 md:-mt-9 font-bold text-black pl-2 lg:pl-0">
                            A partir de : {{ $item['prices'][0]->pivot->cost }} MAD
                          </p>
                          @else
                          <button @click="open = !open" class="text-md md:text-lg font-bold -mt-8 md:-mt-9 text-black pl-2 lg:pl-0">
                            A partir de : {{ $item['lowest_cost'] }} MAD
                          </button>
                          <div x-show="open" @click.away="open = false" class="origin-top-right absolute md:top-0 bottom-0 md:bottom-auto right-0 w-40 rounded-md shadow-lg bg-yellow-200 gradient-bg ring-1 ring-black ring-opacity-5">
                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                @foreach ($item['prices'] as $price)
                                    <a class="block px-4 {{ $loop->last ? '' : 'border-b-2 border-b-black' }} py-2 text-xs md:text-sm font-bold text-black" role="menuitem">
                                        {{ $price->name }} : {{ $price->pivot->cost }} MAD
                                    </a>
                                @endforeach
                            </div>
                        </div>
                          @endif
                          
                        </div>
              
                      
              
                        </div>
                        @if ($item['latitude'])
                        <a target="_blank" href="http://maps.google.com/maps?q={{ $item['latitude'] }},{{ $item['longitude'] }}+(My+Point)&z=14&ll={{ $item['latitude'] }},{{ $item['longitude'] }}">
                          <div class="w-7 h-7 hidden md:flex items-center justify-center rounded-md border border-[#10B981]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 6.9 8 11.7z"/></svg>
                        </div>
                      </a>
                      @endif
              
                      </article>
                      
                      {{-- Fin du post --}}
                @endforeach  
                    @endif
                  </div>