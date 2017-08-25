<?php
namespace Deployer;
require 'recipe/common.php';

// Configuration

set('repository', 'git@github.com:AndyCornelius/deployer-example.git');
set('shared_files', []);
set('shared_dirs', []);
set('writable_dirs', []);
set('keep_releases', 3);
set('allow_anonymous_stats', false);
set('ssh_type', 'native');
set('ssh_multiplexing', true);

// Servers

host('test')
    ->hostname('192.168.1.170')
    ->user('root')
    ->identityFile('~/.ssh/id_rsa')
    ->set('deploy_path', '/mnt/storage/html/deployer-example/deployer');


// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup'
]);

before('deploy', 'startup');
after('deploy', 'success');
