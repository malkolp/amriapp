import os


def rem(path, directory):
    for dirs in directory:
        temp = path + dirs
        for f in os.listdir(temp):
            os.remove(os.path.join(temp, f))


root = 'storage/app/public/'
user_path = 'user/'
student_path = 'student/'
user_dir = ['profile']
student_dir = ['profile', 'transaction']
rem(root + user_path, user_dir)
rem(root + student_path, student_dir)
