<?php

			/* 
			 * 
			 * 
			 * 
			 * 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

			
			
			class Dbreport extends Eloquent{
					
					protected $table = 'dbreports';
//					protected $guarded = array('id');
				protected $fillable = array('id','user_id', 'tx_date','status', 'total', 'telco','created_at','updated_at');
					
					
					
			}
