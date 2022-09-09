<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $trigger = "CREATE TRIGGER `after_insert` AFTER INSERT ON `renovations` FOR EACH ROW

                    BEGIN

                        Declare SearchId
                        	Cursor for

                        		Select * from calculo2s
                        		where calculo2s.year = new.year and calculo2s.renovation_id = new.id;

                        Declare SearchId_Records
                        	Cursor for
                        				select @nb_rows := found_rows();

                        Declare Req
                        	Cursor for

                        		SELECT new.id, new.label, new.year, new.MONTH, new.estimated_quantity,
                        		@KWH_debut := if( new.MONTH < 12, ROUND(((new.estimated_quantity * 4.694 * (DATEDIFF( CONCAT( new.YEAR,'-',12,'-',31 ),CONCAT(new.YEAR, '-', new.MONTH + 1,'-',01)))* 24 * 5.17) / 1000),2) , 'null') AS KWH_debut,
                        		@KWH_apres_travaux := if( new.MONTH < 12, ROUND(((new.estimated_quantity * 4.694 * (DATEDIFF( CONCAT( new.YEAR,'-',12,'-',31 ),CONCAT(new.YEAR, '-', new.MONTH + 1,'-',01))) * 24 * 0.22) / 1000),2) , 'null') AS KWH_apres_travaux,
                        		@CO_Debut := ROUND(@KWH_debut * 0.232, 2) as CO_Debut,
                        		@CO_apres_travaux := ROUND(@KWH_apres_travaux * 0.232, 2) AS CO_apres_travaux
                        		FROM renovations
                        		WHERE renovations.year = new.year and new.label LIKE '%toiture%' AND new.purpose LIKE 'Economies' AND new.estimated_quantity > 0 AND new.MONTH <> 12 and renovations.id = new.id;

                        Declare nb_records
                        	Cursor for
                        				select @nb_records := found_rows();


                        Declare Req2
                        	Cursor for
                        		SELECT new.id, new.label, @yearInCourse := new.year + 1, new.MONTH, new.estimated_quantity,
                        		@KWH_debut := ROUND(((new.estimated_quantity * 4.694 * (DATEDIFF( CONCAT( new.YEAR,'-',12,'-',31 ),CONCAT(new.YEAR, '-', 01,'-',01)))* 24 * 5.17) / 1000),2) AS KWH_debut,
                        		@KWH_apres_travaux := ROUND(((new.estimated_quantity * 4.694 * (DATEDIFF( CONCAT( new.YEAR,'-',12,'-',31 ),CONCAT(new.YEAR, '-', 01,'-',01))) * 24 * 0.22) / 1000),2) AS KWH_apres_travaux,
                        		@CO_Debut := ROUND(@KWH_debut * 0.232, 2) as CO_Debut,
                        		@CO_apres_travaux := ROUND(@KWH_apres_travaux * 0.232, 2) AS CO_apres_travaux
                        		FROM renovations
                        		WHERE renovations.year = new.year and new.label LIKE '%toiture%' AND new.purpose LIKE 'Economies' AND new.estimated_quantity > 0 AND new.MONTH <> 12 and renovations.id = new.id;


                        Open SearchId;
                        open SearchId_Records;

                        	if (@nb_rows = 0)
                        	then
                        		Open Req;
                        		open nb_records;
                        			if (@nb_records > 0 )
                        			then
                        				INSERT INTO calculo2s (renovation_id, year, kwh_before,kwh_after,kwh_eco,co2_before,co2_after,co2_eco, m2, kwh_m2, co2_m2, created_at, updated_at) values (new.id, new.year, round (@KWH_debut, 2),round (@KWH_apres_travaux, 2),round (@KWH_debut - @KWH_apres_travaux, 2),
                        				round(@CO_Debut, 2),round(@CO_apres_travaux, 2),round(@CO_Debut - @CO_apres_travaux, 2), new.estimated_quantity, round(@KWH_apres_travaux / new.estimated_quantity , 2), round(@CO_apres_travaux / new.estimated_quantity , 2), now(), now());

                        			end if;

                        		close nb_records;
                        		Close Req;

                        			Open Req2;
                        				label:
                        				while ( @yearInCourse < year(now() - 1))
                        				do
                        				INSERT INTO calculo2s (renovation_id, year, kwh_before,kwh_after,kwh_eco,co2_before,co2_after,co2_eco, m2, kwh_m2, co2_m2, created_at, updated_at) values ( new.id, @yearInCourse, round (@KWH_debut, 2),round (@KWH_apres_travaux, 2),round (@KWH_debut - @KWH_apres_travaux, 2),
                        				round(@CO_Debut, 2),round(@CO_apres_travaux, 2),round(@CO_Debut - @CO_apres_travaux, 2), new.estimated_quantity, round(@KWH_apres_travaux / new.estimated_quantity , 2), round(@CO_apres_travaux / new.estimated_quantity , 2),now(), now());
                        				set @yearInCourse = @yearInCourse + 1;
                        				END WHILE label;


                        			Close Req2;
                        	end if;


                        close SearchId_Records;
                        close SearchId;
                    END";
        DB::unprepared($trigger);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('after_insert');
    }
};
