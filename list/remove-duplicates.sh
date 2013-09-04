awk '{print $NF}' subs/* | sort | uniq -d | while read email
do
	grep -l $email subs/* | while read file
	do
		echo $email is a duplicate in $file
		rm -v $file
		break
	done
done
