依赖 php 7,2 swoole 
```
#首先需安装ansible
#CentOS 启用epel源之后
yum -y installl ansible
sed -i 's/host_key_checking = False/#host_key_checking = False/' /etc/ansible/ansible.cfg

启动： cd app/tools&& php server.php&
/opt/lampp/xampp start
```
ansible 命令执行 完成
playbook 管理器 完成
playbook 执行  完成

cesgu
php think make:validate HostGroup  创建验证器
