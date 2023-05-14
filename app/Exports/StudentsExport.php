<?php

	namespace App\Exports;

	use App\Models\Student;
	use Illuminate\Database\Eloquent\Collection;
	use Maatwebsite\Excel\Concerns\FromQuery;
	use Maatwebsite\Excel\Concerns\Exportable;
	use Maatwebsite\Excel\Concerns\FromCollection;
	use Maatwebsite\Excel\Concerns\ShouldAutoSize;
	use Maatwebsite\Excel\Concerns\WithHeadings;
	use Maatwebsite\Excel\Concerns\WithMapping;
	use PhpOffice\PhpSpreadsheet\Shared\Date;


	class StudentsExport implements FromQuery, ShouldAutoSize, WithMapping, WithHeadings {

		use Exportable;

		public $students;

		public function __construct(Collection $students) {
			$this->students = $students;
		}

		public function query() {
			return Student::whereKey($this->students->pluck('id')->toArray());
		}

		public function map($student): array
	    {
	        return [
	            $student->id,
	            $student->fullname,
	            $student->matric_no,
	            $student->department->name,
	            $student->level->level,
	            Date::dateTimeToExcel($student->created_at),
	        ];
	    }

	    public function headings(): array
	    {
	        return [
	            'ID',
	            'Fullname',
	            'Matric Number',
	            'Department',
	            'Level',
	            'Created At'
	        ];
	    }

	}
