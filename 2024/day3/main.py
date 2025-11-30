
if __name__ == '__main__':
    ans = 0
    f = open('data.in', 'r')

    data = f.read()


    enabled = True
    for i in range(0, len(data) - 2):

        if i <= len(data) - 4:
            u = data[i:i+4]

        if u == 'do()':
            enabled = True

        if i <= len(data) - 7:
            v = data[i:i+7]

        if v == "don't()":
            enabled = False


        t = data[i:i+3]
        if t == 'mul':
            j = i+3
            after = ''
            while j < len(data) and data[j] != ')':
                if not (data[j].isdigit() or data[j] == '(' or data[j] == ','):
                    after = ''
                    break

                after += data[j]
                j += 1

            if after == '' or after.count(',') != 1 or after.count('(') != 1:
                continue

            comma_pos = after.find(',')
            x = int(after[1:comma_pos])
            y = int(after[comma_pos+1:])
            
            if enabled:
                ans += x * y

    print(ans)
            