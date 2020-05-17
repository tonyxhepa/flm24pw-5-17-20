@extends('layouts.admin')

@section('content')
   <div class="container mx-auto">
       <section class="py-8 px-4">
           <div class="flex flex-wrap -mx-4">
               <div class="w-full lg:w-1/4 px-4 mb-4 lg:mb-0">
                   <div class="h-full border rounded shadow">
                       <div class="flex items-center justify-between px-4 py-3 border-b">
                           <h3 class="text-lg font-heading">Users</h3><span class="py-1 px-3 text-sm text-white font-semibold bg-green-500 rounded-full">All</span>
                       </div>
                       <div class="flex flex-col p-4">
                           <h3 class="text-3xl mb-3 font-heading font-semibold">{{ count($users) }}</h3><span>New Users</span><span class="text-green-500">24%</span>
                       </div>
                   </div>
               </div>
               <div class="w-full lg:w-1/4 px-4 mb-4 lg:mb-0">
                   <div class="h-full border rounded shadow">
                       <div class="flex items-center justify-between px-4 py-3 border-b">
                           <h3 class="text-lg font-heading">Movies</h3><span class="py-1 px-3 text-sm text-white font-semibold bg-green-500 rounded-full">All</span>
                       </div>
                       <div class="flex flex-col p-4">
                           <h3 class="text-3xl mb-3 font-heading font-semibold">{{ count($movies) }}</h3><span>Te Gjitha</span><span class="text-green-500">All visits</span>
                       </div>
                   </div>
               </div>
               <div class="w-full lg:w-1/4 px-4 mb-4 lg:mb-0">
                   <div class="h-full border rounded shadow">
                       <div class="flex items-center justify-between px-4 py-3 border-b">
                           <h3 class="text-lg font-heading">Series</h3><span class="py-1 px-3 text-sm text-white font-semibold bg-green-500 rounded-full">All</span>
                       </div>
                       <div class="flex flex-col p-4">
                           <h3 class="text-3xl mb-3 font-heading font-semibold">{{ count($series) }}</h3><span>Te Gjitha</span><span class="text-green-500">All visits</span>
                       </div>
                   </div>
               </div>
               <div class="w-full lg:w-1/4 px-4 mb-4 lg:mb-0">
                   <div class="h-full border rounded shadow">
                       <div class="flex items-center justify-between px-4 py-3 border-b">
                           <h3 class="text-lg font-heading">Episodes</h3><span class="py-1 px-3 text-sm text-white font-semibold bg-green-500 rounded-full">All</span>
                       </div>
                       <div class="flex flex-col p-4">
                           <h3 class="text-3xl mb-3 font-heading font-semibold">{{ count($episodes) }}</h3><span>Te Gjitha</span><span class="text-green-500">All visits</span>
                       </div>
                   </div>
               </div>
           </div>
       </section>
       <section class="py-8 px-4">
           <div class="flex flex-wrap -mx-4">
               <div class="w-full lg:w-1/4 px-4 mb-4 lg:mb-0">
                   <div class="h-full border rounded shadow">
                       <div class="flex items-center justify-between px-4 py-3 border-b">
                           <h3 class="text-lg font-heading">Casts</h3><span class="py-1 px-3 text-sm text-white font-semibold bg-green-500 rounded-full">All</span>
                       </div>
                       <div class="flex flex-col p-4">
                           <h3 class="text-3xl mb-3 font-heading font-semibold">{{ count($casts) }}</h3><span>New Users</span><span class="text-green-500">24%</span>
                       </div>
                   </div>
               </div>
           </div>
       </section>
   </div>
@endsection
