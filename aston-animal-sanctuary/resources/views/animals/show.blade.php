@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Animal details') }}
    </h2>
@endsection
@section('content')
    <div class="container">
        <!-- display request success status -->
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div><br />
        @endif

        @if ($animal == null)
            <div class="alert alert-danger">
                @component('components.alerts.error')

                    <li>Please choose an animal from the animal list!</li>

                @endcomponent
            </div><br />
        @else
            <div class="relative py-3 sm:max-w-xl sm:mx-auto">
                <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                    <div class="max-w-md mx-auto">

                        <div class="block  font-semibold text-xl self-start text-gray-700">
                            <h1 class="leading-relaxed">{{ $animal->name }}</h2>
                        </div>
                        
                        <div class="divide-y divide-gray-200">
                            <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                <div class="flex flex-col">
                                    @if ($animal->image == 0)
                                        <img class="w-1/3 h-auto" src="{{ asset('storage/images/placeholder.png') }}"
                                            alt="">
                                    @elseif ($animal->image == 1)
                                        {{-- <img class="w-auto3 h-auto"
                                            src="{{ asset('storage/images/' . $images->where('animal_id', $animal->id)->first()->image_location) }}"
                                            alt=""> --}}



                                            <section class="mx-auto max-w-2xl">
                                                
                                                  <!-- large image on slides -->
                                                  
                                                  @foreach ($images->where('animal_id', $animal->id) as $image)
                                                      <div class="mySlides hidden">
                                                         
                                                          <img class="w-full h-auto  object-cover"
                                                          src="{{ asset('storage/images/' . $image->image_location) }}"
                                                          alt="">
                                                      </div>
                                                  @endforeach
                                                  <!-- buttons -->
                                                  <a class="absolute left-0 inset-y-0 flex items-center -mt-32 px-4 text-white hover:text-gray-800 cursor-pointer text-3xl font-extrabold" onclick="plusSlides(-1)">❮</a>
                                                  <a class="absolute right-0 inset-y-0 flex items-center -mt-32 px-4 text-white hover:text-gray-800 cursor-pointer text-3xl font-extrabold" onclick="plusSlides(1)">❯</a>
                                            
                                                  <!-- image description -->
                                                  <div class="text-center text-white font-light tracking-wider bg-gray-400 py-2">
                                                    <p id="caption"></p>
                                                  </div>
                                            
                                                  <!-- smaller images under description -->
                                                  <div class="flex">
                                                    <?php $index = 0; ?>
                                                    @foreach ($images->where('animal_id', $animal->id) as $image)
                                                        <div>
                                                            <?php $index = $index + 1; ?>
                                                            <img class="w-48 h-48 opacity-50 hover:opacity-100 cursor-pointer"
                                                            src="{{ asset('storage/images/' . $image->image_location) }}"
                                                            alt="" onclick="currentSlide($index)">
                                                        </div>
                                                    @endforeach
                                                    
                                                  </div>
                                                </div>
                                              </section>
                                            
                                            
                                              <script>
                                                //JS to switch slides and replace text in bar//
                                                var slideIndex = 1;
                                                showSlides(slideIndex);
                                            
                                                function plusSlides(n) {
                                                  showSlides(slideIndex += n);
                                                }
                                            
                                                function currentSlide(n) {
                                                  showSlides(slideIndex = n);
                                                }
                                            
                                                function showSlides(n) {
                                                  var i;
                                                  var slides = document.getElementsByClassName("mySlides");
                                                  var dots = document.getElementsByClassName("description");
                                                 
                                                  if (n > slides.length) {
                                                    slideIndex = 1
                                                  }
                                                  if (n < 1) {
                                                    slideIndex = slides.length
                                                  }
                                                  for (i = 0; i < slides.length; i++) {
                                                    slides[i].style.display = "none";
                                                  }
                                                  for (i = 0; i < dots.length; i++) {
                                                    dots[i].className = dots[i].className.replace(" opacity-100", "");
                                                  }
                                                  slides[slideIndex - 1].style.display = "block";
                                                  dots[slideIndex - 1].className += " opacity-100";
                                               
                                                }
                                              </script>









                                        
                                    @endif
                                </div>



                                <div class="flex items-center space-x-4">
                                    <div class="flex flex-col w-1/2">
                                        <label class="font-bold leading-loose">Animal name</label>
                                        {{ $animal->name }}
                                    </div>
                                    <div class="flex flex-col w-1/2">
                                        <label class="font-bold leading-loose">Animal species</label>
                                        {{ $animal->species }}
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4">
                                    <div class="flex flex-col w-1/2">
                                        <label class="font-bold leading-loose">Breed</label>
                                        {{ $animal->breed }}
                                    </div>
                                    <div class="flex flex-col w-1/2">
                                        <label class="font-bold leading-loose">Age</label>
                                        {{ $animal->age }}
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4">
                                    <div class="flex flex-col w-1/2">
                                        <label class="font-bold leading-loose">Colour</label>
                                        {{ $animal->colour }}
                                    </div>
                                    @if (Auth::user() != null && Auth::user()->type == 1)
                                        <div class="flex flex-col w-1/2">
                                            <label class="font-bold leading-loose">Owner</label>
                                            @if ($animal['owner_id'] == null)
                                                No owner
                                            @else

                                                @foreach ($users as $user)

                                                    @if ($user->id == $animal['owner_id'])
                                                        {{ $user->name }}
                                                    @endif
                                                @endforeach
                                            @endif
                                            </td>
                                        </div>
                                    @endif

                                </div>
                            </div>


                            <table class="table-auto">
                                <td><a href="{{ route('animals.index') }}"
                                        class=" w-1/3 text-gray-900 px-4 py-3 rounded-md focus:outline-none"
                                        role="button">Back
                                        to the
                                        list</a></td>

                                {{-- Check that animal is unowned before allowing a new adoption request --}}
                                @if ($animal['owner_id'] == null)
                                    <td><a href="{{ route('requests.adopt', ['id' => $animal['id']]) }}"
                                            class="  w-1/3 text-gray-900 px-4 py-3 rounded-md focus:outline-none">Adopt this
                                            animal</a></td>
                                @endif
                                @if (Auth::user() != null && Auth::user()->type == 1)
                                    <td> <a href="{{ route('animals.edit', ['animal' => $animal['id']]) }}"
                                            class="w-1/3 text-gray-900 px-4 py-3 rounded-md focus:outline-none">Edit</a>
                                    </td>

                                    <td>
                                        <form action="{{ route('animals.destroy', ['animal' => $animal['id']]) }}"
                                            method="post"> @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button class="flex w-1/3 text-gray-900 px-4 py-3 rounded-md focus:outline-none"
                                                type="submit">Delete</button>
                                        </form>
                                    </td>

                                @endif
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            @endif
        </div>
    </div>


@endsection
