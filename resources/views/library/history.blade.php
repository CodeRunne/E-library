<x-dashboard-layout title="Loan History">
<main class="w-full relative flex flex-col lg:flex-row px-3 py-4 items-start">
        <!-- aside -->
        <x-book-aside/>
        
        <!-- books section -->
        <section class="w-full mt-8 lg:mt-0 lg:w-[70%] px-3">
                
            <section>
                <div class="text-sm mb-6">
                    <span class="font-bold underline decoration-dotted text-primary-900"><a href="{{ route('library.profile') }}">{{ auth()->user()->matric_no }}</a></span>
                    <span>/</span>
                    <span class="font-bold underline decoration-dotted text-primary-900"><a href="{{ route('library.profile') }}">Loan</a></span>
                    <span>/</span>
                    <span>History</span>
                </div>
                <h3 class="text-2xl font-bold text-milk-900 border-b border-gray-300 pb-3">Loan History</h3>

                <div class="mt-6">
                  <div class="dashboard-tables-table-container overflow-x-auto relative border border-gray-200 rounded-md">
                    <table class="dashboard-tables-table w-full text-start divide-y table-auto divide-milk-200">
                      <thead>
                        <tr class="bg-gray-200">
                          <th class="dashboard-tables-header-cell p-0 dashboard-table-header-cell-id">
                            <button type="button" class="flex items-center gap-x-1 w-full px-4 py-2 whitespace-nowrap font-medium text-sm text-milk-900 cursor-default ">
                              <span>
                                Book
                              </span>
                            </button>
                          </th>
                          <th class="dashboard-tables-header-cell p-0 dashboard-table-header-cell-level">
                            <button type="button" class="flex items-center gap-x-1 w-full px-4 py-2 whitespace-nowrap font-medium text-sm text-milk-900 cursor-default">
                              <span>
                                  Borrowed Date
                              </span>    
                            </button>
                          </th>
                          <th class="dashboard-tables-header-cell p-0 dashboard-table-header-cell-level">
                            <button type="button" class="flex items-center gap-x-1 w-full px-4 py-2 whitespace-nowrap font-medium text-sm text-milk-900 cursor-default">
                              <span>
                                  Return Date
                              </span>    
                            </button>
                          </th>
                          <th class="dashboard-tables-header-cell p-0 dashboard-table-header-cell-level">
                            <button type="button" class="flex items-center gap-x-1 w-full px-4 py-2 whitespace-nowrap font-medium text-sm text-milk-900 cursor-default">
                              <span>
                                  Returned
                              </span>    
                            </button>
                          </th>
                        </tr>                                              
                      </thead>
                      <tbody class="divide-y whitespace-nowrap  divide-milk-200">
                        @forelse($books as $book)
                          <tr class="dashboard-tables-row transition hover:bg-gray-50  hover:bg-gray-500/10">
                            <td class="dashboard-tables-cell text-milk-900 text-md dashboard-table-cell-level">
                              <div class="dashboard-tables-column-wrapper">
                                <div class="dashboard-tables-text-column px-4 py-3">
                                  <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                                    <div class="flex items-center gap-x-3">
                                      <div class="w-[3.5rem] h-[4rem] bg-red-100 rounded-sm shadow">
                                        <img src="{{ asset('/storage/'.$book->getBook($book->book_id)->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover rounded-sm">
                                      </div>
                                      <span class="inline-block text-sm">{{ $book->getBook($book->book_id)->title }}</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td class="dashboard-tables-cell  text-milk-900 text-md dashboard-table-cell-level">
                              <div class="dashboard-tables-column-wrapper">
                                <div class="dashboard-tables-text-column px-4 py-3">
                                  <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                                    <span class="text-sm">
                                        {{ $book->created_at->format('j/m/Y - h:s:ia') }}
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td class="dashboard-tables-cell  text-milk-900 text-md dashboard-table-cell-level">
                              <div class="dashboard-tables-column-wrapper">
                                <div class="dashboard-tables-text-column px-4 py-3">
                                  <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                                    <span class="text-sm">
                                        {{ date('j/m/Y - h:s:ia', strtotime($book->return_date)) }}
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td class="dashboard-tables-cell  text-milk-900 text-md dashboard-table-cell-level">
                              <div class="dashboard-tables-column-wrapper">
                                <div class="dashboard-tables-text-column px-4 py-3">
                                  <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                                    <span class="font-bold text-sm">
                                        {{ ($book->borrowed == true && time() < strtotime($book->return_date)) ? 'pending' : 'returned' }}
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                        @empty
                          <p>none</p>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                  {{$books->links()}}
                </div>
            </section>
        </section>
    </main>
</x-dashboard-layout>