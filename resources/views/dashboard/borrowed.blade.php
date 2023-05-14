<x-dashboard-layout>
	
	<main class="mt-6 max-w-4xl mx-auto">
		<div>
			<h3>Borrowed Books</h3>

			<div class="dashboard-tables-table-container overflow-x-auto relative border border-gray-700 rounded-md">
                <table class="dashboard-tables-table w-full text-start divide-y table-auto divide-gray-700">
            		<thead>
            			<tr class="bg-gray-500/5">
                            <th class="dashboard-tables-header-cell p-0 dashboard-table-header-cell-id">
    							<button type="button" class="flex items-center gap-x-1 w-full px-4 py-2 whitespace-nowrap font-medium text-sm text-gray-300 cursor-default ">
	        						<span>
							            Book
							        </span>
				            	</button>
							</th>
                            
                            <th class="dashboard-tables-header-cell p-0 dashboard-table-header-cell-level">
    							<button type="button" class="flex items-center gap-x-1 w-full px-4 py-2 whitespace-nowrap font-medium text-sm text-gray-300 cursor-default">
							        <span>
							            Student Matric Number
							        </span>    
							    </button>
							</th>
							<th class="dashboard-tables-header-cell p-0 dashboard-table-header-cell-level">
    							<button type="button" class="flex items-center gap-x-1 w-full px-4 py-2 whitespace-nowrap font-medium text-sm text-gray-300 cursor-default">
							        <span>
							            Returned
							        </span>    
							    </button>
							</th>
							<th class="dashboard-tables-header-cell p-0 dashboard-table-header-cell-level">
    							<button type="button" class="flex items-center gap-x-1 w-full px-4 py-2 whitespace-nowrap font-medium text-sm text-gray-300 cursor-default">
							        <span>
							            Action
							        </span>    
							    </button>
							</th>
						</tr>                                              
        			</thead>
				    <tbody class="divide-y whitespace-nowrap  divide-gray-700">
        				<tr class="dashboard-tables-row transition hover:bg-gray-50  hover:bg-gray-500/10">
    						<td class="dashboard-tables-cell  text-white dashboard-table-cell-level">
							    <div class="dashboard-tables-column-wrapper">
						            <div class="dashboard-tables-text-column px-4 py-3">
									    <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
									        <span class="">
									            100
									        </span>
										</div>
									</div>
								</div>
							</td>
							<td class="dashboard-tables-cell  text-white dashboard-table-cell-level">
							    <div class="dashboard-tables-column-wrapper">
						            <div class="dashboard-tables-text-column px-4 py-3">
									    <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
									        <span class="">
									            19/EG/ME/1361
									        </span>
										</div>
									</div>
								</div>
							</td>
							<td class="dashboard-tables-cell  text-white dashboard-table-cell-level">
							    <div class="dashboard-tables-column-wrapper">
						            <div class="dashboard-tables-text-column px-4 py-3">
									    <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
									        <span class="">
									            100
									        </span>
										</div>
									</div>
								</div>
							</td>
							<td class="dashboard-tables-cell  text-white dashboard-table-cell-level">
							    <div class="dashboard-tables-column-wrapper">
						            <div class="dashboard-tables-text-column px-4 py-3">
									    <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
									        <span class="">
									            100
									        </span>
										</div>
									</div>
								</div>
							</td>
                        </tr>
    				</tbody>
    			</table>
            </div>
		</div>
	</main>

</x-dashboard-layout>