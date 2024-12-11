<template>    
            
    
    <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
        <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
            <div>
                <h5 class="mr-3 font-semibold dark:text-white">
                <slot name="title" />
                </h5>
                <p class="text-gray-500 dark:text-gray-400">
                <slot name="subtitle" />
                </p>
            </div>
            <div class="flex space-x-1 items-center" >
               <slot name="buttons" />
            </div>
            
        </div>
        <slot/>
    </div>
            

</template>