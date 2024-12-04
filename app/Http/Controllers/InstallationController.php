<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;


class InstallationController extends Controller
{
    // Show Installation Form
	public function showForm()
	{
    	return view('install');
	}

	// Handle Form Submission
	public function runInstallation(Request $request)
	{
    	// Validate the input
    	$request->validate([
        	'db_host' => 'required',
        	'db_port' => 'required',
        	'db_database' => 'required',
        	'db_username' => 'required',
        	'db_password' => 'nullable',
    	]);

    	// Update the .env file
    	$this->updateEnv([
        	'DB_HOST' => $request->db_host,
        	'DB_PORT' => $request->db_port,
        	'DB_DATABASE' => $request->db_database,
        	'DB_USERNAME' => $request->db_username,
        	'DB_PASSWORD' => $request->db_password,
    	]);

    	// Run Artisan commands
    	try {
            Artisan::call('migrate', ['--force' => true]);
            $output = Artisan::output(); // Capture Artisan output
            logger('Migration Output: ' . $output);
        
            return redirect()->back()->with('success', 'Installation completed successfully!');
        } catch (\Exception $e) {
            logger('Migration Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error during installation: ' . $e->getMessage());
        }
	}

	// Update .env file
	private function updateEnv($data)
	{
    	$envPath = base_path('.env');
    	$envContent = File::get($envPath);

    	foreach ($data as $key => $value) {
        	$envContent = preg_replace(
            	"/^{$key}=.*$/m",
            	"{$key}={$value}",
            	$envContent
        	);
    	}

    	File::put($envPath, $envContent);
	}

}
